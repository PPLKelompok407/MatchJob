<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MikatController extends Controller
{
    public function showBeforeTest()
    {
        return view('pages.testMikat.beforeTest');
    }
    
    public function showSoal($page = 1)
    {
        $soalMikat = DB::table('test_mikat')->get();
        
        // Check if questions exist
        if ($soalMikat->isEmpty()) {
            return redirect()->route('pages.dashboard')->with('error', 'Soal tes belum tersedia');
        }
        
        // Ensure page number is valid
        $page = (int)$page;
        if ($page < 1) {
            $page = 1;
        } elseif ($page > $soalMikat->count()) {
            $page = $soalMikat->count();
        }
        
        // Get stored answers from session
        $answers = session('mikat_answers', []);
        
        // Get flagged questions from session
        $flaggedQuestions = session('mikat_flagged', []);
        
        return view('pages.testMikat.test', [
            'soalMikat' => $soalMikat,
            'currentPage' => $page,
            'answers' => $answers,
            'flaggedQuestions' => $flaggedQuestions
        ]);
    }
    
    public function storeAnswer(Request $request, $page)
    {
        // Validate time
        $currentTime = $request->input('current_time');
        if ($currentTime > 5400) { // 90 minutes in seconds
            // Time exceeded, reset session and redirect to first page
            Session::forget(['mikat_answers', 'mikat_flagged']);
            return redirect()->route('mikat.before')->with('error', 'Waktu habis! Silakan mulai tes dari awal.');
        }
        
        // Get stored answers
        $answers = session('mikat_answers', []);
        
        // Store answer if provided
        $answerKey = 'jawaban_' . $page;
        if ($request->has($answerKey)) {
            // Hanya update lembar sekarang sudah di answer
            $answers[$answerKey] = $request->input($answerKey);
            session(['mikat_answers' => $answers]);
        }
        
        // Handle flagging if provided
        if ($request->has('flag')) {
            $flaggedQuestions = session('mikat_flagged', []);
            if (in_array($page, $flaggedQuestions)) {
                $flaggedQuestions = array_diff($flaggedQuestions, [$page]);
            } else {
                $flaggedQuestions[] = $page;
            }
            session(['mikat_flagged' => $flaggedQuestions]);
        }
        
        // Get next page or redirect to submit
        $nextPage = $request->input('next_page', (int)$page + 1);
        $soalCount = DB::table('test_mikat')->count();
        
        if ((int)$nextPage > $soalCount || $request->has('submit')) {
            // Memeriksa jika semua pertanyaan telah terjawab sebelum di submit
            if (count($answers) === $soalCount) {
                return $this->submitJawaban($request);
            } else {
                // Find the first unanswered question
                for ($i = 1; $i <= $soalCount; $i++) {
                    if (!isset($answers['jawaban_' . $i])) {
                        return redirect()->route('mikat.show', ['page' => $i])
                                ->with('warning', 'Ada beberapa pertanyaan yang belum dijawab. Silakan lengkapi semua pertanyaan.');
                    }
                }
                return $this->submitJawaban($request);
            }
        }
        
        return redirect()->route('mikat.show', ['page' => $nextPage]);
    }

    public function submitJawaban(Request $request)
    {
        // Get all answers from session
        $answers = session('mikat_answers', []);
        
        // Check if all questions are answered
        $soalCount = DB::table('test_mikat')->count();
        if (count($answers) < $soalCount) {
            return redirect()->route('mikat.show', ['page' => 1])
                    ->with('warning', 'Mohon jawab semua pertanyaan sebelum mengirimkan tes.');
        }
        
        $skor = [// skor awal sebelum memulai test
            'kreatif' => 0,
            'sosial' => 0,
            'teknikal' => 0,
            'manajerial' => 0
        ];
        
        // Logika penilaian berdasarkan jawaban berdasarkan RIASEC
        foreach($answers as $key => $value) {
            switch($value) {
                case 'opsi_1':
                    $skor['kreatif'] += 1;
                    break;
                case 'opsi_2':
                    $skor['sosial'] += 1;
                    break;
                case 'opsi_3':
                    $skor['teknikal'] += 1;
                    break;
                case 'opsi_4':
                    $skor['manajerial'] += 1;
                    break;
            }
        }

        $totalSkor = array_sum($skor);

        // Simpan skor ke session
        session(['skor_mikat' => $skor]);
        session(['total_skor_mikat' => $totalSkor]);
        
        // Clear test session data
        Session::forget(['mikat_answers', 'mikat_flagged']);
        
        // Clear localStorage timer data
        Session::flash('clear_timer', true);

        $user = Auth::user();
        $kategoriTertinggi = array_search(max($skor), $skor);
        $hasilMikat = $this->getKategoriMikat($kategoriTertinggi);
        $user->test_mikat = $hasilMikat;
        $user->save();

        // Update penempatan kerja jika kedua tes sudah dilakukan
        if ($user->tes_teknis) {
            $penempatan = app(PenempatanController::class)->updatePenempatan($user->tes_teknis, $hasilMikat);
            $user->penempatan_kerja = $penempatan;
            $user->save();
        }
        
        return redirect()->route('hasil.mikat')->with('success', 'Tes minat dan bakat telah berhasil diselesaikan!');
    }

    public function showHasil()
    {// scoring hasil testing  minat bakat
        $skor = session('skor_mikat');
        $totalSkor = session('total_skor_mikat');

        if (!$skor || !$totalSkor) {
            return redirect()->route('mikat.before')->with('error', 'Anda belum mengerjakan tes minat dan bakat');
        }

        return view('pages.testMikat.hasil', compact('skor', 'totalSkor'));
    }

    public function flagQuestion(Request $request, $page)
    {//fitur bendera untuk menandai pertanyaan
        $flaggedQuestions = session('mikat_flagged', []);
        
        if (in_array($page, $flaggedQuestions)) {
            $flaggedQuestions = array_diff($flaggedQuestions, [$page]);
        } else {
            $flaggedQuestions[] = $page;
        }
        
        session(['mikat_flagged' => $flaggedQuestions]);
        
        return redirect()->back();
    }

    private function getKategoriMikat($kategori)
    {
        $kategoriMikat = [// deskripsi kategori minat dan bakat
            'kreatif' => 'Kreatif (Seni, Desain, dan Kreativitas)',
            'sosial' => 'Sosial (Komunikasi dan Hubungan Interpersonal)',
            'teknikal' => 'Teknikal (Teknik dan Analisis)',
            'manajerial' => 'Manajerial (Kepemimpinan dan Manajemen)'
        ];

        return $kategoriMikat[$kategori] ?? 'Belum dapat ditentukan';
    }
}

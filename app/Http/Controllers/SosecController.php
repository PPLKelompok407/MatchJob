<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SosecController extends Controller
{
    public function showBeforeTest()
    {
        return view('pages.testSosec.beforeTest');
    }
    
    public function showSoal($page = 1)
    {
        $soalSosec = DB::table('test_sosec')->get();
        
        // Check if questions exist
        if ($soalSosec->isEmpty()) {
            return redirect()->route('pages.dashboard')->with('error', 'Soal tes belum tersedia');
        }
        
        // Ensure page number is valid
        $page = (int)$page;
        if ($page < 1) {
            $page = 1;
        } elseif ($page > $soalSosec->count()) {
            $page = $soalSosec->count();
        }
        
        // Get stored answers from session
        $answers = session('sosec_answers', []);
        
        // Get flagged questions from session
        $flaggedQuestions = session('sosec_flagged', []);
        
        return view('pages.testSosec.test', [
            'soalSosec' => $soalSosec,
            'currentPage' => $page,
            'answers' => $answers,
            'flaggedQuestions' => $flaggedQuestions
        ]);
    }
    
    public function storeAnswer(Request $request, $page)
    {
        // Validate time
        $currentTime = $request->input('current_time');
        if ($currentTime > 1800) { // 30 minutes in seconds
            // Time exceeded, reset session and redirect to first page
            Session::forget(['sosec_answers', 'sosec_flagged']);
            return redirect()->route('sosec.before')->with('error', 'Waktu habis! Silakan mulai tes dari awal.');
        }
        
        // Get stored answers
        $answers = session('sosec_answers', []);
        
        // Store answer if provided - only update the current page's answer
        if ($request->has('jawaban') && isset($request->input('jawaban')[$page])) {
            if (!isset($answers['jawaban'])) {
                $answers['jawaban'] = [];
            }
            $answers['jawaban'][$page] = $request->input('jawaban')[$page];
            session(['sosec_answers' => $answers]);
        }
        
        // Handle flagging if provided
        if ($request->has('flag')) {
            $flaggedQuestions = session('sosec_flagged', []);
            if (in_array($page, $flaggedQuestions)) {
                $flaggedQuestions = array_diff($flaggedQuestions, [$page]);
            } else {
                $flaggedQuestions[] = $page;
            }
            session(['sosec_flagged' => $flaggedQuestions]);
        }
        
        // Get next page or redirect to submit
        $nextPage = $request->input('next_page', (int)$page + 1);
        $soalCount = DB::table('test_sosec')->count();
        
        if ((int)$nextPage > $soalCount || $request->has('submit')) {
            // Check if all questions are answered before final submission
            if (isset($answers['jawaban']) && count($answers['jawaban']) === $soalCount) {
                return $this->submit($request);
            } else {
                // Find the first unanswered question
                for ($i = 1; $i <= $soalCount; $i++) {
                    if (!isset($answers['jawaban'][$i])) {
                        return redirect()->route('sosec.show', ['page' => $i])
                                ->with('warning', 'Ada beberapa pertanyaan yang belum dijawab. Silakan lengkapi semua pertanyaan.');
                    }
                }
                return $this->submit($request);
            }
        }
        
        return redirect()->route('sosec.show', ['page' => $nextPage]);
    }

    public function submit(Request $request)
    {
        // Get all answers from session
        $answers = session('sosec_answers', []);
        
        // Verify we have answers
        if (!isset($answers['jawaban'])) {
            return redirect()->route('sosec.before')->with('warning', 'Anda belum mengerjakan tes softskill RIASEC.');
        }
        
        $jawaban = $answers['jawaban'];
        
        // Inisialisasi skor RIASEC
        $skor = [
            'realistic' => 0,
            'investigative' => 0,
            'artistic' => 0,
            'social' => 0,
            'enterprising' => 0,
            'conventional' => 0
        ];

        // Hitung skor berdasarkan kategori soal
        foreach ($jawaban as $soalId => $nilai) {
            $kategori = $this->getKategoriSoal($soalId);
            $skor[$kategori] += (int)$nilai;
        }

        // Hitung total skor
        $totalSkor = array_sum($skor);
        
        // Hindari pembagian dengan nol
        if ($totalSkor == 0) {
            $totalSkor = 1; // Set default ke 1 untuk menghindari division by zero
        }

        // Urutkan skor dari tertinggi ke terendah
        arsort($skor);

        // Ambil 3 skor tertinggi
        $topThree = array_slice($skor, 0, 3, true);

        // Simpan ke session
        session([
            'skor_riasec' => $skor,
            'total_skor_riasec' => $totalSkor,
            'top_three' => $topThree
        ]);
        
        // Clear test ses
    }

    public function flagQuestion(Request $request, $page)
    {
        $flaggedQuestions = session('sosec_flagged', []);
        
        if (in_array($page, $flaggedQuestions)) {
            $flaggedQuestions = array_diff($flaggedQuestions, [$page]);
        } else {
            $flaggedQuestions[] = $page;
        }
        
        session(['sosec_flagged' => $flaggedQuestions]);
        
        return redirect()->back();
    }

    public function hasil()
    {
        $skor = session('skor_riasec');
        $totalSkor = session('total_skor_riasec');
        $topThree = session('top_three');

        if (!$skor || !$totalSkor || !$topThree) {
            return redirect()->route('sosec.before')->with('error', 'Anda belum mengerjakan tes RIASEC');
        }

        // Deskripsi untuk setiap tipe RIASEC
        $deskripsi = [
            'realistic' => 'Tipe Realistis - Anda menyukai pekerjaan yang melibatkan penggunaan alat, mesin, atau aktivitas fisik. Anda cenderung praktis, langsung, dan menyukai bekerja dengan objek, mesin, tanaman, atau hewan.',
            'investigative' => 'Tipe Investigatif - Anda menyukai pekerjaan yang melibatkan analisis, penelitian, dan pemecahan masalah. Anda cenderung analitis, intelektual, dan menyukai tugas-tugas yang abstrak dan membutuhkan pemikiran mendalam.',
            'artistic' => 'Tipe Artistik - Anda menyukai pekerjaan yang melibatkan kreativitas dan ekspresi diri. Anda cenderung imajinatif, mandiri, dan menyukai lingkungan yang bebas dan tidak terstruktur.',
            'social' => 'Tipe Sosial - Anda menyukai pekerjaan yang melibatkan interaksi dengan orang lain dan membantu orang. Anda cenderung ramah, kooperatif, dan menyukai bekerja dalam tim dan membantu orang lain.',
            'enterprising' => 'Tipe Wirausaha - Anda menyukai pekerjaan yang melibatkan kepemimpinan dan pengambilan keputusan. Anda cenderung percaya diri, ambisius, dan menyukai aktivitas yang melibatkan persuasi dan kepemimpinan.',
            'conventional' => 'Tipe Konvensional - Anda menyukai pekerjaan yang terstruktur dan mengikuti prosedur yang jelas. Anda cenderung terorganisir, teliti, dan menyukai lingkungan kerja yang teratur dan terstruktur.'
        ];

        // Rekomendasi karir untuk setiap kombinasi 3 huruf teratas
        $rekomendasi = $this->getRekomendasiKarir(array_keys($topThree));

        return view('pages.testSosec.hasil', compact('skor', 'totalSkor', 'topThree', 'deskripsi', 'rekomendasi'));
    }

    private function getRekomendasiKarir($topThreeTypes)
    {
        $kode = implode('', array_map(function($type) {
            return strtoupper(substr($type, 0, 1));
        }, $topThreeTypes));

        $rekomendasiKarir = [
            // R combinations
            'RIA' => ['Insinyur', 'Peneliti Teknis', 'Arsitek', 'Ilmuwan Material', 'Desainer Produk'],
            'RIS' => ['Dokter Hewan', 'Teknisi Medis', 'Perawat', 'Ahli Terapi Fisik', 'Teknisi Laboratorium'],
            'RIE' => ['Insinyur Industri', 'Manajer Teknis', 'Konsultan IT', 'Analis Sistem', 'Manajer Produksi'],
            'RIC' => ['Spesialis QA', 'Teknisi Laboratorium', 'Analis Data', 'Pengawas Produksi', 'Ahli Statistik'],
            'RAS' => ['Desainer Interior', 'Ahli Terapi Seni', 'Ahli Lanskap', 'Fotografer Alam', 'Teknisi Audio Visual'],
            'RAE' => ['Desainer Produk', 'Fotografer Komersial', 'Desainer Industri', 'Direktur Teknis', 'Entrepreneur Kreatif'],
            'RAC' => ['Arsitek', 'Drafter Teknis', 'Ilustrator Teknis', 'Desainer Grafis Teknis', 'Pengawas Konstruksi'],
            'RSI' => ['Ahli Terapi Fisik', 'Ahli Kesehatan Kerja', 'Teknisi Medis', 'Perawat Bedah', 'Instruktur Kesehatan'],
            'RSA' => ['Pelatih Olahraga', 'Guru Pendidikan Jasmani', 'Terapis Rekreasi', 'Instruktur Kebugaran', 'Ahli Terapi Seni'],
            'RSE' => ['Manajer Proyek Konstruksi', 'Supervisor Layanan Kesehatan', 'Koordinator Keselamatan', 'Manajer Fasilitas', 'Koordinator Program Rekreasi'],
            'RSC' => ['Teknisi Medis', 'Koordinator Kesehatan & Keselamatan', 'Spesialis Rehabilitasi', 'Teknisi Laboratorium Medis', 'Pengawas Konstruksi'],
            'REI' => ['Manajer Teknis', 'Kontraktor', 'Pengembang Real Estate', 'Insinyur Penjualan', 'Pengusaha Teknologi'],
            'RES' => ['Supervisor Konstruksi', 'Manajer Fasilitas', 'Manajer Proyek', 'Direktur Program Rekreasi', 'Koordinator Keselamatan'],
            'REA' => ['Produsen Film', 'Pengusaha Desain', 'Kontraktor Perumahan', 'Manajer Produksi', 'Supervisor Desain'],
            'REC' => ['Manajer Konstruksi', 'Supervisor Produksi', 'Manajer Operasional', 'Koordinator Logistik', 'Spesialis Kontrol Inventaris'],
            'RCI' => ['Analis Sistem Komputer', 'Teknisi Kontrol Kualitas', 'Spesialis Keamanan Data', 'Teknisi Jaringan', 'Administrator Sistem'],
            'RCA' => ['Drafter CAD', 'Spesialis GIS', 'Operator Produksi', 'Spesialis Kontrol Kualitas', 'Teknisi Pencetakan'],
            'RCS' => ['Koordinator Kesehatan & Keselamatan', 'Spesialis Rekam Medis', 'Pengawas Konstruksi', 'Teknisi Medis', 'Spesialis Kepatuhan'],
            'RCE' => ['Manajer Operasional', 'Supervisor Produksi', 'Manajer Proyek Teknis', 'Spesialis Logistik', 'Manajer Fasilitas'],
            
            // I combinations
            'IRA' => ['Ilmuwan Forensik', 'Ahli Antropologi Fisik', 'Arkeolog', 'Insinyur Biomedis', 'Ilmuwan Material'],
            'IRS' => ['Dokter', 'Dokter Hewan', 'Pakar Epidemiologi', 'Farmakolog', 'Ahli Kesehatan Lingkungan'],
            'IRE' => ['Direktur Riset & Pengembangan', 'Manajer Lab', 'Ilmuwan Data', 'Konsultan Teknis', 'Arsitek Sistem'],
            'IRC' => ['Analis Sistem', 'Administrator Database', 'Programmer', 'Ahli Statistik', 'Farmasis'],
            'IAS' => ['Psikolog', 'Konselor', 'Profesor Seni', 'Arkeolog', 'Antropolog'],
            'IAR' => ['Ilmuwan Forensik', 'Desainer Eksperimen', 'Peneliti Medis', 'Arkeolog', 'Ilmuwan Lingkungan'],
            'IAE' => ['Professor Seni', 'Peneliti Pasar', 'Kritikus Seni', 'Konsultan Kreatif', 'Peneliti Media'],
            'IAC' => ['Kurator Museum', 'Ahli Perpustakaan', 'Editor Teknis', 'Arkeolog', 'Arsiparis'],
            'ISR' => ['Dokter', 'Ilmuwan Medis', 'Ahli Epidemiologi', 'Spesialis Kesehatan Lingkungan', 'Psikolog Klinis'],
            'ISA' => ['Peneliti', 'Professor', 'Antropolog', 'Psikolog', 'Analis Kebijakan'],
            'ISE' => ['Dokter', 'Ilmuwan Data', 'Ekonom', 'Konsultan Manajemen', 'Epidemiolog'],
            'ISC' => ['Peneliti Medis', 'Spesialis Informasi Kesehatan', 'Analis Kebijakan', 'Statistikawan', 'Peneliti Pasar'],
            'IER' => ['Direktur Riset', 'Manajer Proyek Penelitian', 'Konsultan Teknis', 'Pengembang Usaha Teknologi', 'Manajer Produk'],
            'IES' => ['Profesor Bisnis', 'Analis Kebijakan', 'Konsultan Manajemen', 'Ekonom', 'Peneliti Pasar'],
            'IEA' => ['Peneliti Pasar', 'Ekonom', 'Analis Kebijakan', 'Konsultan Media', 'Konsultan Strategi'],
            'IEC' => ['Analis Finansial', 'Ilmuwan Data', 'Analis Sistem', 'Analis Bisnis', 'Konsultan Manajemen'],
            'ICR' => ['Programmer', 'Analis Sistem', 'Teknisi Lab', 'Ahli Statistik', 'Administrator Database'],
            'ICS' => ['Analis Kebijakan', 'Spesialis Informasi Kesehatan', 'Analis Riset', 'Statistikawan', 'Analis Data'],
            'ICE' => ['Analis Finansial', 'Analis Sistem', 'Programmer', 'Peneliti Ekonomi', 'Analisis Data'],
            'ICA' => ['Ahli Perpustakaan', 'Kurator', 'Arsiparis', 'Editor Teknis', 'Programmer'],
            
            // A combinations
            'ARI' => ['Arsitek', 'Desainer Produk', 'Ilmuwan Material', 'Teknisi Audio', 'Fotografer Sains'],
            'ARS' => ['Terapis Seni', 'Guru Seni', 'Desainer Interior Medis', 'Fotografer Alam', 'Ilustrator Medis'],
            'ARE' => ['Desainer Produk', 'Sutradara Film', 'Arsitek', 'Pengembang Game', 'Manajer Kreatif'],
            'ARC' => ['Arsitek', 'Drafter CAD', 'Ilustrator Teknis', 'Desainer Interior', 'Spesialis CAD'],
            'AIR' => ['Arsitek', 'Ilmuwan Material', 'Desainer Produk', 'Ilustrator Medis', 'Arkeolog'],
            'AIS' => ['Psikolog', 'Antropolog', 'Psikoterapis Seni', 'Musikoterapis', 'Peneliti Sosial'],
            'AIE' => ['Peneliti Pasar', 'Profesor Seni', 'Desainer UX', 'Konsultan Kreatif', 'Pengembang Kebijakan Seni'],
            'AIC' => ['Kurator', 'Arsiparis', 'Editor', 'Peneliti', 'Ilmuwan Data Kreatif'],
            'ASR' => ['Terapis Seni', 'Guru Seni', 'Terapis Musik', 'Instruktur Teater', 'Terapis Rekreasi'],
            'ASI' => ['Psikolog', 'Antropolog', 'Psikoterapis Seni', 'Musikoterapis', 'Peneliti Sosial'],
            'ASE' => ['Direktur Kreatif', 'Manajer Seni', 'Terapis Seni', 'Guru Seni', 'Manajer Program Seni'],
            'ASC' => ['Kurator Museum', 'Arsiparis', 'Terapis Seni', 'Koordinator Program Seni', 'Spesialis Media Perpustakaan'],
            'AER' => ['Sutradara Film', 'Desainer Produk', 'Arsitek', 'Manajer Kreatif', 'Pengembang Game'],
            'AEI' => ['Peneliti Pasar', 'Konsultan Media', 'Desainer UX', 'Analisis Tren', 'Pengembang Strategi Kreatif'],
            'AES' => ['Direktur Kreatif', 'Desainer UI/UX', 'Manajer Produk Digital', 'Entrepreneur Kreatif', 'Penulis Konten'],
            'AEC' => ['Manajer Kreatif', 'Direktur Seni', 'Desainer UI/UX', 'Koordianator Produksi', 'Manajer Media'],
            'ACR' => ['Drafter CAD', 'Ilustrator Teknis', 'Desainer Teknis', 'Arsitek', 'Animator Teknis'],
            'ACI' => ['Editor', 'Arsiparis', 'Kurator', 'Spesialis Media Informasi', 'Analis Media'],
            'ACS' => ['Arsiparis', 'Koordinator Media Perpustakaan', 'Spesialis Pendidikan Museum', 'Administrator Seni', 'Koordinator Program Seni'],
            'ACE' => ['Manajer Media', 'Editor', 'Direktur Seni', 'Koordinator Produksi', 'Administrator Program Seni'],
            
            // S combinations
            'SRI' => ['Perawat', 'Dokter', 'Ahli Fisioterapi', 'Teknisi Medis', 'Instruktur Keselamatan'],
            'SRA' => ['Guru Pendidikan Jasmani', 'Terapis Rekreasi', 'Pelatih', 'Terapis Okupasi', 'Guru Seni'],
            'SRE' => ['Manajer Layanan Kesehatan', 'Manajer Program Rekreasi', 'Koordinator Keselamatan', 'Supervisor Rehabilitasi', 'Manajer Fasilitas'],
            'SRC' => ['Koordinator Layanan Kesehatan', 'Spesialis Rekam Medis', 'Koordinator Keselamatan', 'Teknisi Lab Medis', 'Spesialis Rehabilitasi'],
            'SIR' => ['Dokter', 'Perawat Spesialis', 'Psikolog Klinis', 'Terapis Fisik', 'Spesialis Kesehatan Lingkungan'],
            'SIA' => ['Psikolog', 'Konselor', 'Guru Seni', 'Antropolog', 'Terapis Seni'],
            'SIE' => ['Direktur Program Pendidikan', 'Konsultan Kesehatan', 'Peneliti Pendidikan', 'Administrator Kesehatan', 'Konselor Karir'],
            'SIC' => ['Spesialis Informasi Kesehatan', 'Analis Kebijakan Kesehatan', 'Peneliti Pendidikan', 'Spesialis Rekam Medis', 'Konselor'],
            'SAR' => ['Terapis Okupasi', 'Terapis Rekreasi', 'Guru Seni', 'Terapis Fisik', 'Instruktur Teater'],
            'SAI' => ['Psikolog', 'Konselor', 'Terapis Seni', 'Antropolog', 'Musikoterapis'],
            'SAE' => ['Direktur Program Seni', 'Guru Seni', 'Terapis Seni', 'Konsultan Pendidikan', 'Koordinator Program Kreatif'],
            'SAC' => ['Administrator Program Seni', 'Koordinator Pendidikan Museum', 'Guru Seni', 'Terapis Seni', 'Spesialis Media Perpustakaan'],
            'SER' => ['Pekerja Sosial Medis', 'Terapis Okupasi', 'Pelatih/Coach', 'Konsultan Kesehatan', 'Manajer Rekreasi'],
            'SEI' => ['Administrator Kesehatan', 'Peneliti Pendidikan', 'Direktur Program', 'Konsultan Kebijakan Sosial', 'Manajer Layanan Pendukung'],
            'SEA' => ['Direktur Program Seni', 'Administrator Pendidikan', 'Manajer Program Komunitas', 'Fundraiser', 'Manajer Program Sosial'],
            'SEC' => ['Administrator Pendidikan', 'Manajer HR', 'Konselor Karir', 'Spesialis Pelatihan', 'Koordinator Program'],
            'SCR' => ['Teknisi Medis', 'Koordinator Layanan Kesehatan', 'Spesialis Rehabilitasi', 'Koordinator Keselamatan', 'Perawat'],
            'SCI' => ['Spesialis Informasi Kesehatan', 'Analis Kebijakan Kesehatan', 'Peneliti Pendidikan', 'Perawat Informatika', 'Spesialis Perencanaan Program'],
            'SCE' => ['Administrator Kesehatan', 'Manajer Kantor Medis', 'Koordinator Layanan', 'Manajer HR', 'Spesialis Pelatihan'],
            'SCA' => ['Koordinator Program Seni', 'Spesialis Media Perpustakaan', 'Administrator Seni', 'Guru', 'Petugas Administrasi Pendidikan'],
            
            // E combinations
            'ERI' => ['Manajer Teknis', 'Direktur R&D', 'Konsultan Teknik', 'Wirausahawan Teknologi', 'Manajer Proyek IT'],
            'ERS' => ['Manajer Layanan Kesehatan', 'Supervisor Keselamatan', 'Manajer Konstruksi', 'Manajer Program Rekreasi', 'Direktur Fasilitas'],
            'ERA' => ['Produser Film', 'Wirausahawan Desain', 'Manajer Produksi Kreatif', 'Pengembang Real Estate', 'Direktur Kreatif'],
            'ERC' => ['Manajer Konstruksi', 'Manajer Operasional', 'Supervisor Produksi', 'Manajer Proyek', 'Wirausahawan Manufaktur'],
            'EIR' => ['Direktur R&D', 'Manajer Produk', 'Konsultan Teknologi', 'Wirausahawan Teknologi', 'Manajer Program Teknis'],
            'EIS' => ['Administrator Kesehatan', 'Konsultan Manajemen Kesehatan', 'Direktur Program Pendidikan', 'Konselor Karir', 'Peneliti Pasar'],
            'EIA' => ['Konsultan Media', 'Peneliti Pasar', 'Pengembang Kebijakan', 'Analis Tren', 'Wirausahawan Kreatif'],
            'EIC' => ['Konsultan Manajemen', 'Analis Finansial', 'Analis Bisnis', 'Wirausahawan Teknologi', 'Pengembang Strategi'],
            'ESR' => ['Manajer Layanan Kesehatan', 'Administrator Rumah Sakit', 'Manajer Fasilitas', 'Direktur Layanan Sosial', 'Koordinator Program Komunitas'],
            'ESI' => ['Administrator Kesehatan', 'Konsultan Manajemen Kesehatan', 'Direktur Program Pendidikan', 'Peneliti Kebijakan Sosial', 'Direktur Layanan Sosial'],
            'ESA' => ['Direktur Program Seni', 'Administrator Pendidikan', 'Manajer Seni dan Budaya', 'Direktur Program Rekreasi', 'Fundraiser'],
            'ESC' => ['Administrator Pendidikan', 'Direktur HR', 'Manajer Program', 'Direktur Pelayanan', 'Koordinator Layanan Sosial'],
            'EAR' => ['Produser Film', 'Desainer Produk', 'Manajer Produksi Kreatif', 'Arsitek', 'Wirausahawan Desain'],
            'EAI' => ['Konsultan Media', 'Analis Tren', 'Peneliti Pasar Kreatif', 'Manajer Kreatif', 'Pengembang Strategi Konten'],
            'EAS' => ['Direktur Kreatif', 'Desainer UI/UX', 'Manajer Produk Digital', 'Entrepreneur Kreatif', 'Penulis Konten'],
            'EAC' => ['Manajer Media', 'Direktur Kreatif', 'Manajer Produksi', 'Koordinator Pemasaran', 'Administrator Program Seni'],
            'ECR' => ['Manajer Operasional', 'Supervisor Produksi', 'Manajer Konstruksi', 'Manajer Proyek', 'Spesialis Logistik'],
            'ECI' => ['Analis Finansial', 'Manajer Sistem Informasi', 'Analis Bisnis', 'Wirausahawan Teknologi', 'Konsultan Manajemen'],
            'ECS' => ['Manajer HR', 'Administrator', 'Manajer Kantor', 'Direktur Layanan', 'Koordinator Program'],
            'ECA' => ['Manajer Media', 'Administrator Program Seni', 'Direktor Pemasaran', 'Manajer Produksi', 'Manajer Konten'],
            
            // C combinations
            'CRI' => ['Teknisi Lab', 'Spesialis Keamanan Jaringan', 'Teknisi Kontrol Kualitas', 'Programmer', 'Analis QA'],
            'CRS' => ['Teknisi Medis', 'Spesialis Kepatuhan', 'Spesialis K3', 'Koordinator Logistik Medis', 'Pengawas Konstruksi'],
            'CRE' => ['Manajer Operasional', 'Supervisor Produksi', 'Manajer Proyek', 'Koordinator Logistik', 'Pengawas Kualitas'],
            'CRA' => ['Drafter CAD', 'Operator CAM', 'Teknisi Audio', 'Spesialis Kontrol Dokumen', 'Teknisi Pencetakan'],
            'CIR' => ['Programmer', 'Analis Sistem', 'Teknisi Lab', 'Spesialis QA', 'Administrator Database'],
            'CIS' => ['Analis Riset', 'Spesialis Informasi Kesehatan', 'Statistikawan', 'Analis Kebijakan', 'Peneliti Data'],
            'CIE' => ['Analis Finansial', 'Analis Bisnis', 'Programmer', 'Analis Sistem', 'Akuntan Forensik'],
            'CIA' => ['Editor', 'Arsiparis', 'Analis Media', 'Spesialis Katalog', 'Administrator Database'],
            'CSR' => ['Teknisi Medis', 'Spesialis Rekam Medis', 'Koordinator Administrasi Medis', 'Petugas Kepatuhan', 'Spesialis Klaim Asuransi'],
            'CSI' => ['Spesialis Informasi Kesehatan', 'Analis Kebijakan', 'Peneliti Data', 'Petugas Administrasi Kesehatan', 'Akuntan Kesehatan'],
            'CSE' => ['Manajer Kantor Medis', 'HR Administrator', 'Koordinator Layanan', 'Petugas Administrasi', 'Spesialis Pelatihan'],
            'CSA' => ['Koordinator Program Seni', 'Petugas Administrasi Pendidikan', 'Spesialis Media Perpustakaan', 'Administrator Program', 'Petugas Administrasi Museum'],
            'CER' => ['Manajer Operasional', 'Supervisor Produksi', 'Manajer Proyek', 'Koordinator Logistik', 'Pengawas Kualitas'],
            'CEI' => ['Analis Finansial', 'Manajer Sistem Informasi', 'Pengembang Bisnis', 'Akuntan', 'Analis Pasar'],
            'CES' => ['Manajer Administrasi', 'Analis Keuangan', 'Spesialis HR', 'Konsultan Keuangan', 'Manajer Kantor'],
            'CEA' => ['Administrator Program Seni', 'Manajer Media', 'Koordinator Produksi', 'Manajer Konten', 'Administrator Acara'],
            'CAR' => ['Drafter CAD', 'Teknisi Desain', 'Spesialis Kontrol Dokumen', 'Illustrator Teknis', 'Operator Produksi'],
            'CAI' => ['Editor', 'Arsiparis', 'Kurator', 'Analis Media', 'Spesialis Katalog'],
            'CAS' => ['Koordinator Program Seni', 'Petugas Administrasi Museum', 'Spesialis Media Perpustakaan', 'Administrator Pendidikan', 'Petugas Perpustakaan'],
            'CAE' => ['Administrator Program Seni', 'Koordinator Produksi', 'Manajer Media', 'Manajer Konten', 'Koordinator Acara']
        ];

        // Jika kode tidak ditemukan, berikan rekomendasi umum
        return $rekomendasiKarir[$kode] ?? [
            'Karir sesuai dengan tipe ' . implode(', ', $topThreeTypes),
            'Konsultasikan dengan penasehat karir untuk rekomendasi lebih spesifik',
            'Eksplorasi bidang yang sesuai dengan kombinasi minat Anda'
        ];
    }

    private function getKategoriSoal($soalId)
    {
        if ($soalId >= 1 && $soalId <= 5) {
            return 'realistic';
        } elseif ($soalId >= 6 && $soalId <= 10) {
            return 'investigative';
        } elseif ($soalId >= 11 && $soalId <= 15) {
            return 'artistic';
        } elseif ($soalId >= 16 && $soalId <= 20) {
            return 'social';
        } elseif ($soalId >= 21 && $soalId <= 25) {
            return 'enterprising';
        } elseif ($soalId >= 26 && $soalId <= 30) {
            return 'conventional';
        }
        
        return 'realistic'; // default fallback
    }

    private function getOrderedRiasecCode($topThree)
    {
        // Standard RIASEC order
        $riasecOrder = ['realistic', 'investigative', 'artistic', 'social', 'enterprising', 'conventional'];
        
        // Get the types (keys) from topThree
        $types = array_keys($topThree);
        
        // Filter and sort types according to standard RIASEC order
        $orderedTypes = [];
        foreach ($riasecOrder as $type) {
            if (in_array($type, $types)) {
                $orderedTypes[] = $type;
            }
        }
        
        // Take only the first 3 (should already be 3, but just to be safe)
        $orderedTypes = array_slice($orderedTypes, 0, 3);
        
        // Convert to code (first letter of each, uppercase)
        $code = implode('', array_map(function($type) {
            return strtoupper(substr($type, 0, 1));
        }, $orderedTypes));
        
        return $code;
    }
}

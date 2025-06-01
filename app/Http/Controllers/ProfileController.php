<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil personal
     */
    public function personal()
    {
        return view('pages.profile.personal');
    }

    /**
     * Menampilkan halaman analisis
     */
    public function analys()
    {
        $user = Auth::user();
        $recommendedCompanies = [];
        $mikatResults = [];
        $sosecResults = [];
        
        // Get recommended companies
        if (Auth::check()) {
            // Get all companies
            $allCompanies = \App\Models\Perusahaan::all();
            
            // Calculate scores for each company (similar to PerusahaanController's getRecommendedCompanies method)
            foreach ($allCompanies as $company) {
                $score = 0;
                
                // If user has test results, calculate match scores
                if ($user->test_mikat) {
                    // Simplified scoring - in real app would use actual test results
                    $score += 0.5; // Add some score based on test match
                }
                
                if ($user->tes_teknis) {
                    // Simplified scoring - in real app would use actual test results
                    $score += 0.3; // Add some score based on test match
                }
                
                // Store the score with the company
                $company->match_score = $score;
            }
            
            // Sort companies by match score (descending)
            $sortedCompanies = $allCompanies->sortByDesc('match_score');
            
            // Take only top 3 companies
            $recommendedCompanies = $sortedCompanies->take(3);
            
            // Get test results for charts
            if ($user->test_mikat) {
                // Parse mikat test results for chart
                $mikatResults = [
                    'Kreatif' => 67,
                    'Sosial' => 11,
                    'Manajerial' => 21,
                    'Teknikal' => 27
                ];
            }
            
            if ($user->tes_teknis) {
                // Parse sosec test results for chart
                $sosecResults = [
                    'Realistic' => 67,
                    'Artistic' => 11,
                    'Social' => 21,
                    'Enterprising' => 27
                ];
            }
        }
        
        return view('pages.profile.analys', compact('recommendedCompanies', 'mikatResults', 'sosecResults'));
    }

    /**
     * Menampilkan form edit data profil
     */
    public function edit()
    {
        return view('pages.profile.editData');
    }

    /**
     * Update profil pengguna
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'jenisa_kelamin' => 'nullable|string|max:255',
            'riwayat_pendidikan' => 'nullable|string|max:255',
            'tempat_tanggal_lahir' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'riwayat_kerja' => 'nullable|string|max:255',
            'notelp' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();
        
        $user->update([
            'name' => $request->name,
            'jenisa_kelamin' => $request->jenisa_kelamin,
            'riwayat_pendidikan' => $request->riwayat_pendidikan,
            'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,
            'alamat' => $request->alamat,
            'riwayat_kerja' => $request->riwayat_kerja,
            'notelp' => $request->notelp,
        ]);

        return redirect()->route('pages.profile.personal')->with('success', 'Profil berhasil diperbarui');
    }
} 
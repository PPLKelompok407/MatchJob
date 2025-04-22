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
        return view('pages.profile.analys');
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
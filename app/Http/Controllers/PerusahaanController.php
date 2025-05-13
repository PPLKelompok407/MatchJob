<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perusahaan;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the companies.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Perusahaan::query();
        
        // Handle search if provided
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('bagian', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
        }
        
        // Get the perusahaan data
        $perusahaan = $query->get();
        
        return view('pages.perusahaan.listperusahaan', compact('perusahaan'));
    }
}

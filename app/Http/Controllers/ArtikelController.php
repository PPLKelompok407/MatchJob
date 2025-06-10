<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the articles for admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $artikels = Artikel::orderBy('id', 'desc');

        if ($request->has('search')) {
            $artikels = $artikels->where('judul', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category')) {
            $artikels = $artikels->where('category', $request->category);
        }

        $artikels = $artikels->paginate(10);

        return view('admin.artikel.index', compact('artikels'));
    }

    /**
     * Display the public artikel page with filtering capabilities.
     *
     * @return \Illuminate\View\View
     */
    public function publicIndex()
    {
        return view('pages.artikel.artikel');
    }

    /**
     * Show the form for creating a new article.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.artikel.create');
    }

    /**
     * Store a newly created article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'required|string',
            'link' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store image in public/artikel directory instead of storage
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('artikel'), $imageName);
        $imagePath = 'artikel/' . $imageName;

        Artikel::create([
            'judul' => $request->judul,
            'category' => $request->category,
            'description' => $request->description,
            'link' => $request->link,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        
        return view('admin.artikel.edit', compact('artikel'));
    }

    /**
     * Update the specified article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'required|string',
            'link' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'category' => $request->category,
            'description' => $request->description,
            'link' => $request->link,
        ];

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($artikel->image && file_exists(public_path($artikel->image))) {
                unlink(public_path($artikel->image));
            }
            
            // Store new image in public/artikel directory
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('artikel'), $imageName);
            $data['image'] = 'artikel/' . $imageName;
        }

        $artikel->update($data);

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil diperbarui');
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        
        // Delete image if it exists
        if ($artikel->image && file_exists(public_path($artikel->image))) {
            unlink(public_path($artikel->image));
        }
        
        $artikel->delete();

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil dihapus');
    }
} 
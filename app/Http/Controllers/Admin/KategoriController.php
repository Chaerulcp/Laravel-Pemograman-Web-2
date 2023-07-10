<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriStoreRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategoriStoreRequest $request)
    {
        $image = $request->file('image')->store('/public/kategori');

        Kategori::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'image' => $image, 
        ]);
        return to_route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     * 
     */
    
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);
        $image = $kategori->image;
        if($request->hasFile('image')) {
            Storage::delete($kategori->image);
            $image = $request->file('image')->store('/public/kategori');
        }

        $kategori->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'image' => $image, 
        ]);
        return to_route('admin.kategori.index')->with('success', 'Kategori berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        Storage::delete($kategori->image);
        $kategori->menu()->detach();
        $kategori->delete();
        return to_route('admin.kategori.index')->with('danger', 'Kategori berhasil dihapus');
    }
}

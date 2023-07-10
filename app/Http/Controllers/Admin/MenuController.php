<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = Menu::all();
        return view('admin.menu.index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.menu.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuStoreRequest $request)
    {
        $image = $request->file('image')->store('/public/menu');

        $menu = Menu::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'image' => $image,
            'harga' => $request->harga,
            
        ]);

        if ($request->has('kategori')) {
            $menu->kategori()->attach($request->kategori);
        }


        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $kategori = Kategori::all();
        return view('admin.menu.edit', compact('menu', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
            $request->validate([
                'nama' => 'required',
                'deskripsi' => 'required',
                'harga' => 'required'
            ]);
            $image = $menu->image;
            if($request->hasFile('image')) {
                Storage::delete($menu->image);
                $image = $request->file('image')->store('/public/menu');
            }

            $menu->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'image' => $image,
                'harga' => $request->harga
            ]);

            if ($request->has('kategori')) {
                $menu->kategori()->sync($request->kategori);
            }

            return to_route('admin.menu.index')->with('success', 'Menu berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * 
     */
    public function destroy(Menu $menu)
    {
        $menu->kategori()->detach();
        Storage::delete($menu->image);
        $menu->delete();
        return to_route('admin.menu.index')->with('danger', 'Menu berhasil dihapus');
    }
}

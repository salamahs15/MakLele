<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class ProdukController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('produk.index', compact('menus'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok'  => 'required|numeric|min:0',
        ]);

        Menu::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok'  => $request->stok,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('produk.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok'  => 'required|numeric|min:0',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok'  => $request->stok,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}

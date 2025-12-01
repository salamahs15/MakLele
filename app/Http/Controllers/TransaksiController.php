<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Menu;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $keranjang = Session::get('keranjang', []);
        return view('transaksi.index', compact('menus', 'keranjang'));
    }

    public function tambahKeranjang($id)
    {
        $menu = Menu::findOrFail($id);
        $keranjang = Session::get('keranjang', []);

        if(isset($keranjang[$id])){
            $keranjang[$id]['jumlah'] += 1;
        } else {
            $keranjang[$id] = [
                'nama' => $menu->nama,
                'harga' => $menu->harga,
                'jumlah' => 1
            ];
        }

        Session::put('keranjang', $keranjang);
        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang');
    }

    public function hapusItem($id)
    {
        $keranjang = Session::get('keranjang', []);
        if(isset($keranjang[$id])){
            unset($keranjang[$id]);
            Session::put('keranjang', $keranjang);
        }
        return redirect()->back()->with('success', 'Item berhasil dihapus');
    }

    public function updateJumlah(Request $request, $id)
{
    $keranjang = Session::get('keranjang', []);

    if (isset($keranjang[$id])) {

        $menu = Menu::find($id);

        // CEK STOK
        if ($request->jumlah > $menu->stok) {
            return response()->json([
                'success' => false,
                'message' => 'Jumlah yang dibeli tidak boleh melebihi stok yang tersedia!'
            ]);
        }

        // Jika aman → update jumlah
        $keranjang[$id]['jumlah'] = $request->jumlah;
        Session::put('keranjang', $keranjang);

        return response()->json([
            'success' => true,
            'subtotal' => $keranjang[$id]['harga'] * $keranjang[$id]['jumlah'],
            'total' => array_sum(array_map(fn($item) => $item['harga'] * $item['jumlah'], $keranjang))
        ]);
    }

    return response()->json(['success' => false]);
}



    public function simpan(Request $request)
    {
        $keranjang = Session::get('keranjang', []);
        if(empty($keranjang)){
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        // Hitung total
        $total = array_sum(array_map(fn($item) => $item['harga'] * $item['jumlah'], $keranjang));
        $tunai = $request->tunai;
        $kembalian = $tunai - $total;

        if($tunai < $total){
            return redirect()->back()->with('error', 'Uang tunai kurang!');
        }

        // Simpan transaksi
        $transaksi = Transaksi::create([
            'total' => $total,
            'tunai' => $tunai,
            'kembalian' => $kembalian,
            'status' => 'selesai'
        ]);

        // Detail + pengurangan stok
        foreach($keranjang as $id => $item){

            $menu = Menu::find($id);
            if($menu){
                $menu->stok -= $item['jumlah'];
                $menu->save();
            }

            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'menu_id' => $id,
                'jumlah' => $item['jumlah'],
                'subtotal' => $item['harga'] * $item['jumlah']
            ]);
        }

        Session::forget('keranjang');

        // ⬅⬅⬅ FIX: langsung ke halaman NOTA
        return redirect()->route('transaksi.nota', $transaksi->id);
    }

    // Halaman Nota
    public function nota($id)
    {
        $transaksi = Transaksi::with('detail.menu')->findOrFail($id);
        return view('transaksi.selesai', compact('transaksi'));
    }

    public function selesai($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = 'selesai';
        $transaksi->save();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi selesai');
    }

    public function tambahDropdown(Request $request)
{
    $id = $request->produk_id;
    return $this->tambahKeranjang($id);
}
 

}

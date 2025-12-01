public function simpan(Request $request)
{
    $keranjang = Session::get('keranjang', []);
    if (empty($keranjang)) {
        return redirect()->back()->with('error', 'Keranjang kosong!');
    }

    $total = collect($keranjang)->sum(fn($item) => $item['harga'] * $item['jumlah']);
    $tunai = $request->tunai;

    // Validasi uang cukup
    if ($tunai < $total) {
        return redirect()->back()
            ->with('error', 'Uang kurang! Mohon masukkan nominal yang cukup.')
            ->withInput();
    }

    $kembalian = $tunai - $total;

    // Simpan transaksi induk
    $transaksi = Transaksi::create([
        'total' => $total,
        'tunai' => $tunai,
        'kembalian' => $kembalian,
    ]);

    // Simpan detail + kurangi stok
    foreach ($keranjang as $id => $item) {

        DetailTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'menu_id' => $id,
            'jumlah' => $item['jumlah'],
            'subtotal' => $item['harga'] * $item['jumlah'],
        ]);

        // Kurangi stok menu
        $menu = Menu::find($id);
        if ($menu) {
            $menu->stok -= $item['jumlah'];
            $menu->save();
        }
    }

    // Kosongkan keranjang
    Session::forget('keranjang');

    return redirect()->route('transaksi.selesai', $transaksi->id)
        ->with('success', 'Transaksi berhasil disimpan!');
}

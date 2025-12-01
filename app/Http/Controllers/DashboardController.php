<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total produk & total transaksi
        $totalProduk = Menu::count();  
        $totalTransaksi = Transaksi::count();

        // ================================
        //       GRAFIK 6 BULAN TERAKHIR
        // ================================
        $bulan = [];
        $totalPenjualan = [];

        for ($i = 5; $i >= 0; $i--) {

            $month = Carbon::now()->subMonths($i);

            // Nama bulan untuk label grafik
            $bulan[] = $month->translatedFormat('F');

            // Ambil total penjualan berdasarkan BULAN & TAHUN
            $total = Transaksi::whereMonth('created_at', $month->format('m'))
                              ->whereYear('created_at', $month->format('Y'))
                              ->sum('total');   // ← pakai kolom yang BENAR

            $totalPenjualan[] = $total;
        }

        return view('dashboard.index', [
            'totalProduk'     => $totalProduk,
            'totalTransaksi'  => $totalTransaksi,
            'bulan'           => $bulan,
            'totalPenjualan'  => $totalPenjualan
        ]);
    }
}

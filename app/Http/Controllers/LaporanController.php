<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::orderBy('created_at', 'asc')->get();
        $total = $transaksis->sum('total');
        return view('laporan.index', compact('transaksis', 'total'));
    }

    public function filter(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $transaksis = Transaksi::whereDate('created_at', $tanggal)->get();
        $total = $transaksis->sum('total');
        return view('laporan.index', compact('transaksis', 'total', 'tanggal'));
    }

    public function cetak(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $transaksis = Transaksi::when($tanggal, fn($q) => $q->whereDate('created_at', $tanggal))
            ->orderBy('created_at', 'asc')
            ->get();
        $total = $transaksis->sum('total');

        $pdf = Pdf::loadView('laporan.cetak', compact('transaksis', 'total', 'tanggal'))
                  ->setPaper('a4', 'portrait');
        return $pdf->stream('laporan_penjualan.pdf');
    }
}

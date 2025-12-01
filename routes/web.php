<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth');


Route::get('/forgot-password', function () {
    return view('auth.forgot');
})->name('forgot');

Route::post('/forgot-password', [App\Http\Controllers\ForgotPasswordController::class, 'resetPassword'])
    ->name('forgot.submit');


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect('/dashboard');
    });

    // Dashboard
   Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
   Route::get('/cek-transaksi', function () {
    return dd(\App\Models\Transaksi::first());
});



    // Produk
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::post('/produk/{id}/update', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/tambah/{id}', [TransaksiController::class, 'tambahKeranjang'])->name('transaksi.tambah');
    Route::get('/transaksi/hapus/{id}', [TransaksiController::class, 'hapusItem'])->name('transaksi.hapus');
    Route::post('/transaksi/update/{id}', [TransaksiController::class, 'updateJumlah'])
    ->name('transaksi.updateJumlah');
    Route::post('/transaksi/simpan', [TransaksiController::class, 'simpan'])->name('transaksi.simpan');
    Route::get('/transaksi/selesai/{id}', [TransaksiController::class, 'selesai'])->name('transaksi.selesai');
    Route::get('/transaksi/nota/{id}', [TransaksiController::class, 'nota'])->name('transaksi.nota');
    Route::get('/transaksi/tambah-dropdown', [TransaksiController::class, 'tambahDropdown'])
      ->name('transaksi.tambahDropdown');



    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/filter', [LaporanController::class, 'filter'])->name('laporan.filter');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
});

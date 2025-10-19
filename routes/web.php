<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarisBarang;
use App\Http\Controllers\TransaksiBarangController;

Route::get('/', function () {
    return redirect()->route('inventaris.index');
});

Route::resource('/inventaris', InventarisBarang::class);

// Menampilkan daftar transaksi
Route::get('/transaction', [TransaksiBarangController::class, 'index'])->name('transaksi.index');

// Form transaksi masuk barang baru
Route::get('/transaction/create', [TransaksiBarangController::class, 'create'])->name('transaksi.create');
// Proses barang masuk (barang baru)
Route::post('/transaction/incoming', [TransaksiBarangController::class, 'IncomingTransaction'])->name('transaksi.incoming');

// Proses barang masuk (update stok barang yang sudah ada)
Route::get('/transaction/update', [TransaksiBarangController::class, 'update'])->name('transaksi.update');
Route::post('/transaction/updateTransaction', [TransaksiBarangController::class, 'updateTrsansaction'])->name('transaksi.updateTransaction');


// Proses transaksi keluar (barang keluar)
Route::get('/transaction/destroy', [TransaksiBarangController::class, 'destroy'])->name('transaksi.destroy');
Route::post('/transaction/outbound', [TransaksiBarangController::class, 'OutboundTransaction'])->name('transaksi.outbound');
<?php

use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Support\Facades\Route;

// Customer/publik
Route::get('/', [KatalogController::class, 'landing'])->name('landing');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
Route::get('/produk/{produk}', [KatalogController::class, 'show'])->name('produk.show');

// Dashboard: pengalih otomatis sesuai role
Route::get('/dashboard', function () {
    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.produk.index')
        : redirect()->route('landing');
})->middleware(['auth'])->name('dashboard');

// Profile (bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Customer yang login: keranjang, checkout, riwayat
Route::middleware('auth')->group(function () {
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::patch('/keranjang/{keranjang}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/{keranjang}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
    Route::post('/checkout', [KeranjangController::class, 'checkout'])->name('checkout');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
});

// Admin only
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('produk', ProdukController::class)->except(['show']);
    Route::patch('produk/{produk}/approve', [ProdukController::class, 'approve'])->name('produk.approve');
    Route::patch('produk/{produk}/reject', [ProdukController::class, 'reject'])->name('produk.reject');

    Route::get('pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::patch('pesanan/{pembelian}/confirm', [PesananController::class, 'confirm'])->name('pesanan.confirm');
    Route::patch('pesanan/{pembelian}/reject', [PesananController::class, 'reject'])->name('pesanan.reject');
});

require __DIR__.'/auth.php';
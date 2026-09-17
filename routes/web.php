<?php

use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\KatalogController;
use Illuminate\Support\Facades\Route;

// Customer/publik
Route::get('/', [KatalogController::class, 'landing'])->name('landing');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
Route::get('/produk/{produk}', [KatalogController::class, 'show'])->name('produk.show');

// Admin only
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('produk', ProdukController::class)->except(['show']);
    Route::patch('produk/{produk}/approve', [ProdukController::class, 'approve'])->name('produk.approve');
    Route::patch('produk/{produk}/reject', [ProdukController::class, 'reject'])->name('produk.reject');
});

require __DIR__.'/auth.php';
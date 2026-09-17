<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    protected $primaryKey = 'kode_pembelian';

    protected $fillable = [
        'kode_produk', 'banyak', 'bayar', 'kode_pembeli', 'status',
    ];

    // Relasi: satu transaksi merujuk ke satu produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'kode_produk', 'kode');
    }

    // Relasi: satu transaksi merujuk ke satu user (pembeli)
    public function pembeli()
    {
        return $this->belongsTo(User::class, 'kode_pembeli');
    }
}
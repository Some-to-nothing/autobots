<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'kode';
    public $incrementing = false; // kode bukan angka auto-increment, tapi string
    protected $keyType = 'string';

    protected $fillable = [
        'kode', 'nama', 'tipe', 'jenis', 'kategori',
        'brand', 'kompatibilitas_kendaraan', 'harga', 'stok', 'gambar', 'status_approve',
    ];

    // Relasi: satu produk bisa dibeli di banyak transaksi
    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'kode_produk', 'kode');
    }
}
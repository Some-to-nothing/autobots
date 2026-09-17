<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;

class RiwayatController extends Controller
{
    public function index()
    {
        $pesanan = Pembelian::with('produk')
            ->where('kode_pembeli', auth()->id())
            ->latest()
            ->paginate(10);

        return view('riwayat', compact('pesanan'));
    }
}
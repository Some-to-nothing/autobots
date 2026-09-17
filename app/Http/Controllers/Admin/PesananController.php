<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // Daftar pesanan yang perlu dikonfirmasi (default: pending)
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');
        $pesanan = Pembelian::with(['produk', 'pembeli'])
            ->where('status', $status)
            ->latest()
            ->paginate(15);

        return view('admin.pesanan.index', compact('pesanan', 'status'));
    }

    // Konfirmasi pesanan: stok baru dipotong di sini, bukan saat checkout
    public function confirm(Pembelian $pembelian)
    {
        $produk = $pembelian->produk;

        if ($produk->stok < $pembelian->banyak) {
            return back()->with('error', "Stok {$produk->nama} tidak cukup untuk konfirmasi pesanan ini.");
        }

        $produk->decrement('stok', $pembelian->banyak);
        $pembelian->update(['status' => 'diproses']);

        return back()->with('success', "Pesanan #{$pembelian->kode_pembelian} dikonfirmasi, stok diperbarui.");
    }

    // Tolak pesanan: tidak ada perubahan stok (karena belum pernah dipotong)
    public function reject(Pembelian $pembelian)
    {
        $pembelian->update(['status' => 'dibatalkan']);
        return back()->with('success', "Pesanan #{$pembelian->kode_pembelian} ditolak.");
    }
}
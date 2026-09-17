<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pembelian;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    // Tampilkan isi keranjang milik user yang login
    public function index()
    {
        $items = Keranjang::with('produk')->where('user_id', auth()->id())->get();
        $total = $items->sum(fn ($item) => $item->banyak * $item->produk->harga);

        return view('keranjang', compact('items', 'total'));
    }

    // Tambah produk ke keranjang (dari overlay di halaman detail produk)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_produk' => 'required|exists:produk,kode',
            'banyak' => 'required|integer|min:1',
            'model' => 'nullable|string|max:50',
            'warna' => 'nullable|string|max:50',
        ]);

        $validated['user_id'] = auth()->id();
        Keranjang::create($validated);

        return redirect()->route('keranjang.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    // Ubah jumlah barang di keranjang
    public function update(Request $request, Keranjang $keranjang)
    {
        abort_if($keranjang->user_id !== auth()->id(), 403);

        $request->validate(['banyak' => 'required|integer|min:1']);
        $keranjang->update(['banyak' => $request->banyak]);

        return back()->with('success', 'Jumlah barang diperbarui.');
    }

    // Hapus barang dari keranjang
    public function destroy(Keranjang $keranjang)
    {
        abort_if($keranjang->user_id !== auth()->id(), 403);
        $keranjang->delete();

        return back()->with('success', 'Barang dihapus dari keranjang.');
    }

    // Checkout: konversi semua isi keranjang jadi transaksi pembelian (status pending)
    public function checkout(Request $request)
    {
        $items = Keranjang::with('produk')->where('user_id', auth()->id())->get();

        if ($items->isEmpty()) {
            return back()->with('error', 'Keranjang kosong.');
        }

        foreach ($items as $item) {
            Pembelian::create([
                'kode_produk' => $item->kode_produk,
                'banyak' => $item->banyak,
                'model' => $item->model,
                'warna' => $item->warna,
                'bayar' => $item->banyak * $item->produk->harga,
                'kode_pembeli' => auth()->id(),
                'status' => 'pending', // stok baru dipotong setelah admin konfirmasi
            ]);
        }

        Keranjang::where('user_id', auth()->id())->delete();

        return redirect()->route('riwayat.index')->with('success', 'Checkout berhasil! Pesanan menunggu konfirmasi admin.');
    }
}
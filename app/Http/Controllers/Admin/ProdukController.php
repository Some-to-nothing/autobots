<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Daftar semua produk (buat admin kelola)
    public function index()
    {
        $produk = Produk::latest()->paginate(15);
        return view('admin.produk.index', compact('produk'));
    }

    // Form tambah produk baru
    public function create()
    {
        return view('admin.produk.create');
    }

    // Simpan produk baru — otomatis berstatus pending, nunggu approve
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:20|unique:produk,kode',
            'nama' => 'required|string|max:50',
            'tipe' => 'required|string|max:50',
            'jenis' => 'required|string|max:50',
            'kategori' => 'required|string|max:50',
            'brand' => 'nullable|string|max:50',
            'kompatibilitas_kendaraan' => 'nullable|string|max:100',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|string',
        ]);

        $validated['status_approve'] = 'pending';
        Produk::create($validated);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan, menunggu approve.');
    }

    // Form edit produk
    public function edit(Produk $produk)
    {
        return view('admin.produk.edit', compact('produk'));
    }

    // Update produk
    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'tipe' => 'required|string|max:50',
            'jenis' => 'required|string|max:50',
            'kategori' => 'required|string|max:50',
            'brand' => 'nullable|string|max:50',
            'kompatibilitas_kendaraan' => 'nullable|string|max:100',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|string',
        ]);

        $produk->update($validated);
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diupdate.');
    }

    // Hapus produk
    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    // Approve produk (custom action, bukan bagian resource standar)
    public function approve(Produk $produk)
    {
        $produk->update(['status_approve' => 'approved']);
        return back()->with('success', "Produk {$produk->nama} sudah di-approve.");
    }

    // Reject produk
    public function reject(Produk $produk)
    {
        $produk->update(['status_approve' => 'rejected']);
        return back()->with('success', "Produk {$produk->nama} ditolak.");
    }
}
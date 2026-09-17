<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    // Landing page: barang terlaris, terbaru, kategori
    public function landing()
    {
        $terbaru = Produk::where('status_approve', 'approved')->latest()->take(8)->get();
        // "terlaris" nanti disempurnakan setelah tabel pembelian ada datanya
        $terlaris = Produk::where('status_approve', 'approved')->take(8)->get();
        $kategori = Produk::where('status_approve', 'approved')->distinct()->pluck('kategori');

        return view('landing', compact('terbaru', 'terlaris', 'kategori'));
    }

    // Katalog hasil search
    public function index(Request $request)
    {
        $query = Produk::where('status_approve', 'approved');

        if ($request->filled('q')) {
            $query->where('nama', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $produk = $query->paginate(12)->withQueryString();
        return view('katalog', compact('produk'));
    }

    // Detail produk
    public function show(Produk $produk)
    {
        $serupa = Produk::where('kategori', $produk->kategori)
            ->where('kode', '!=', $produk->kode)
            ->where('status_approve', 'approved')
            ->take(4)->get();

        return view('produk-detail', compact('produk', 'serupa'));
    }
}
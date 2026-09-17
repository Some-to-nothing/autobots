<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold">{{ $produk->nama }}</h1>
        <p class="text-gray-500 mb-2">{{ $produk->kategori }} &middot; {{ $produk->brand }}</p>
        <p class="text-xl font-semibold mb-4">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
        <p class="mb-2">Stok: {{ $produk->stok }}</p>
        <p class="mb-6 text-sm text-gray-600">Kompatibel: {{ $produk->kompatibilitas_kendaraan ?? '-' }}</p>

        {{-- Tombol beli/overlay keranjang menyusul di step selanjutnya --}}
        <button class="bg-gray-800 text-white px-6 py-2 rounded">Beli</button>

        <h2 class="text-lg font-semibold mt-10 mb-4">Produk Serupa</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @forelse($serupa as $item)
                <a href="{{ route('produk.show', $item) }}" class="border rounded-lg p-4 hover:shadow">
                    <p class="font-medium">{{ $item->nama }}</p>
                    <p class="text-sm text-gray-500">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                </a>
            @empty
                <p class="text-gray-500 col-span-4">Belum ada produk serupa.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
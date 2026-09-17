<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <form method="GET" action="{{ route('katalog.index') }}" class="mb-6 flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..." class="border rounded px-3 py-2 flex-1">
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Cari</button>
        </form>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            @forelse($produk as $item)
                <a href="{{ route('produk.show', $item) }}" class="border rounded-lg p-4 hover:shadow">
                    <p class="font-medium">{{ $item->nama }}</p>
                    <p class="text-sm text-gray-500">{{ $item->kategori }}</p>
                    <p class="text-sm text-gray-500">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                </a>
            @empty
                <p class="text-gray-500 col-span-4">Produk tidak ditemukan.</p>
            @endforelse
        </div>

        {{ $produk->links() }}
    </div>
</x-app-layout>
<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Selamat Datang di Supatsu</h1>

        <section class="mb-10">
            <h2 class="text-lg font-semibold mb-4">Produk Terbaru</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse($terbaru as $produk)
                    <a href="{{ route('produk.show', $produk) }}" class="border rounded-lg p-4 hover:shadow">
                        <p class="font-medium">{{ $produk->nama }}</p>
                        <p class="text-sm text-gray-500">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    </a>
                @empty
                    <p class="text-gray-500 col-span-4">Belum ada produk.</p>
                @endforelse
            </div>
        </section>

        <section class="mb-10">
            <h2 class="text-lg font-semibold mb-4">Produk Terlaris</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse($terlaris as $produk)
                    <a href="{{ route('produk.show', $produk) }}" class="border rounded-lg p-4 hover:shadow">
                        <p class="font-medium">{{ $produk->nama }}</p>
                        <p class="text-sm text-gray-500">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    </a>
                @empty
                    <p class="text-gray-500 col-span-4">Belum ada produk.</p>
                @endforelse
            </div>
        </section>

        <section>
            <h2 class="text-lg font-semibold mb-4">Kategori</h2>
            <div class="flex flex-wrap gap-2">
                @forelse($kategori as $kat)
                    <a href="{{ route('katalog.index', ['kategori' => $kat]) }}" class="px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-gray-200">
                        {{ $kat }}
                    </a>
                @empty
                    <p class="text-gray-500">Belum ada kategori.</p>
                @endforelse
            </div>
        </section>
    </div>
</x-app-layout>
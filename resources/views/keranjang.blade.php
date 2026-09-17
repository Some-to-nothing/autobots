<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Keranjang</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">{{ session('error') }}</div>
        @endif

        @forelse($items as $item)
            <div class="flex justify-between items-center border-b py-4">
                <div>
                    <p class="font-medium">{{ $item->produk->nama }}</p>
                    <p class="text-sm text-gray-500">
                        {{ $item->model ?? '-' }} / {{ $item->warna ?? '-' }} &middot; Rp {{ number_format($item->produk->harga, 0, ',', '.') }}
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <form action="{{ route('keranjang.update', $item) }}" method="POST" class="flex items-center gap-2">
                        @csrf @method('PATCH')
                        <input type="number" name="banyak" value="{{ $item->banyak }}" min="1" class="w-16 border rounded px-2 py-1" onchange="this.form.submit()">
                    </form>

                    <p class="font-medium w-28 text-right">Rp {{ number_format($item->banyak * $item->produk->harga, 0, ',', '.') }}</p>

                    <form action="{{ route('keranjang.destroy', $item) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="text-red-600 text-sm">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Keranjang kosong.</p>
        @endforelse

        @if($items->isNotEmpty())
            <div class="flex justify-between items-center mt-6 pt-4 border-t">
                <p class="text-lg font-semibold">Total: Rp {{ number_format($total, 0, ',', '.') }}</p>
                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <button class="bg-gray-800 text-white px-6 py-2 rounded">Checkout</button>
                </form>
            </div>
        @endif
    </div>
</x-app-layout>
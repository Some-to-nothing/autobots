<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Riwayat Pesanan</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        @forelse($pesanan as $item)
            <div class="border rounded-lg p-4 mb-4">
                <div class="flex justify-between">
                    <p class="font-medium">{{ $item->produk->nama }}</p>
                    <span @class([
                        'px-2 py-1 rounded text-xs h-fit',
                        'bg-yellow-100 text-yellow-800' => $item->status === 'pending',
                        'bg-blue-100 text-blue-800' => $item->status === 'diproses',
                        'bg-purple-100 text-purple-800' => $item->status === 'dikirim',
                        'bg-green-100 text-green-800' => $item->status === 'selesai',
                        'bg-red-100 text-red-800' => $item->status === 'dibatalkan',
                    ])>
                        {{ $item->status }}
                    </span>
                </div>
                <p class="text-sm text-gray-500">{{ $item->banyak }}x &middot; {{ $item->model ?? '-' }}/{{ $item->warna ?? '-' }}</p>
                <p class="text-sm font-medium mt-1">Rp {{ number_format($item->bayar, 0, ',', '.') }}</p>
            </div>
        @empty
            <p class="text-gray-500">Belum ada pesanan.</p>
        @endforelse

        <div class="mt-4">{{ $pesanan->links() }}</div>
    </div>
</x-app-layout>
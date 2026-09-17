<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Konfirmasi Pesanan</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">{{ session('error') }}</div>
        @endif

        <div class="flex gap-2 mb-6 text-sm">
            @foreach(['pending' => 'Pending', 'diproses' => 'Diproses', 'dibatalkan' => 'Dibatalkan', 'selesai' => 'Selesai'] as $key => $label)
                <a href="{{ route('admin.pesanan.index', ['status' => $key]) }}"
                   class="px-3 py-1 rounded-full {{ $status === $key ? 'bg-gray-800 text-white' : 'bg-gray-100' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        @forelse($pesanan as $item)
            <div class="border rounded-lg p-4 mb-4 flex justify-between items-center">
                <div>
                    <p class="font-medium">#{{ $item->kode_pembelian }} — {{ $item->produk->nama }}</p>
                    <p class="text-sm text-gray-500">
                        {{ $item->banyak }}x oleh {{ $item->pembeli->name }} &middot; Rp {{ number_format($item->bayar, 0, ',', '.') }}
                    </p>
                    <p class="text-sm text-gray-500">Model/Warna: {{ $item->model ?? '-' }} / {{ $item->warna ?? '-' }}</p>
                </div>

                @if($item->status === 'pending')
                    <div class="flex gap-2">
                        <form action="{{ route('admin.pesanan.confirm', $item) }}" method="POST">
                            @csrf @method('PATCH')
                            <button class="bg-green-600 text-white px-3 py-1 rounded text-sm">Konfirmasi</button>
                        </form>
                        <form action="{{ route('admin.pesanan.reject', $item) }}" method="POST">
                            @csrf @method('PATCH')
                            <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">Tolak</button>
                        </form>
                    </div>
                @endif
            </div>
        @empty
            <p class="text-gray-500">Tidak ada pesanan dengan status ini.</p>
        @endforelse

        <div class="mt-4">{{ $pesanan->links() }}</div>
    </div>
</x-app-layout>
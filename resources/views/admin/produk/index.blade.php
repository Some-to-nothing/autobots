<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Kelola Produk</h1>
            <a href="{{ route('admin.produk.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded">+ Tambah Produk</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        <table class="w-full border-collapse">
            <thead>
                <tr class="border-b text-left text-sm text-gray-500">
                    <th class="py-2">Kode</th>
                    <th class="py-2">Nama</th>
                    <th class="py-2">Kategori</th>
                    <th class="py-2">Harga</th>
                    <th class="py-2">Stok</th>
                    <th class="py-2">Status</th>
                    <th class="py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produk as $item)
                    <tr class="border-b">
                        <td class="py-2">{{ $item->kode }}</td>
                        <td class="py-2">{{ $item->nama }}</td>
                        <td class="py-2">{{ $item->kategori }}</td>
                        <td class="py-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="py-2">{{ $item->stok }}</td>
                        <td class="py-2">
                            <span @class([
                                'px-2 py-1 rounded text-xs',
                                'bg-yellow-100 text-yellow-800' => $item->status_approve === 'pending',
                                'bg-green-100 text-green-800' => $item->status_approve === 'approved',
                                'bg-red-100 text-red-800' => $item->status_approve === 'rejected',
                            ])>
                                {{ $item->status_approve }}
                            </span>
                        </td>
                        <td class="py-2 space-x-2">
                            <a href="{{ route('admin.produk.edit', $item) }}" class="text-blue-600 text-sm">Edit</a>

                            @if($item->status_approve === 'pending')
                                <form action="{{ route('admin.produk.approve', $item) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button class="text-green-600 text-sm">Approve</button>
                                </form>
                                <form action="{{ route('admin.produk.reject', $item) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button class="text-orange-600 text-sm">Reject</button>
                                </form>
                            @endif

                            <form action="{{ route('admin.produk.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="py-4 text-center text-gray-500">Belum ada produk.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $produk->links() }}</div>
    </div>
</x-app-layout>
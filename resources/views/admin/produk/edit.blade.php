<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Edit Produk: {{ $produk->nama }}</h1>

        @if($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.produk.update', $produk) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium mb-1">Kode Produk</label>
                <input type="text" value="{{ $produk->kode }}" class="w-full border rounded px-3 py-2 bg-gray-100" disabled>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $produk->nama) }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tipe</label>
                <input type="text" name="tipe" value="{{ old('tipe', $produk->tipe) }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Jenis</label>
                <input type="text" name="jenis" value="{{ old('jenis', $produk->jenis) }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Kategori</label>
                <select name="kategori" class="w-full border rounded px-3 py-2" required>
                    @foreach(['Mesin','Kelistrikan','Kaki-kaki/Suspensi','Bodi & Eksterior','Interior','Ban & Velg','Rem','Aksesoris/Modifikasi'] as $kat)
                        <option value="{{ $kat }}" @selected(old('kategori', $produk->kategori) === $kat)>{{ $kat }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Brand</label>
                <input type="text" name="brand" value="{{ old('brand', $produk->brand) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Kompatibilitas Kendaraan</label>
                <input type="text" name="kompatibilitas_kendaraan" value="{{ old('kompatibilitas_kendaraan', $produk->kompatibilitas_kendaraan) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Harga</label>
                <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" class="w-full border rounded px-3 py-2" required min="0">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Stok</label>
                <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" class="w-full border rounded px-3 py-2" required min="0">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">URL Gambar</label>
                <input type="text" name="gambar" value="{{ old('gambar', $produk->gambar) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex gap-2 pt-4">
                <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded">Update</button>
                <a href="{{ route('admin.produk.index') }}" class="px-6 py-2 border rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
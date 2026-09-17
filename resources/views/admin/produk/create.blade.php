<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Tambah Produk</h1>

        @if($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.produk.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Kode Produk</label>
                <input type="text" name="kode" value="{{ old('kode') }}" class="w-full border rounded px-3 py-2" required maxlength="20">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tipe</label>
                <input type="text" name="tipe" value="{{ old('tipe') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Jenis</label>
                <input type="text" name="jenis" value="{{ old('jenis') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Kategori</label>
                <select name="kategori" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach(['Mesin','Kelistrikan','Kaki-kaki/Suspensi','Bodi & Eksterior','Interior','Ban & Velg','Rem','Aksesoris/Modifikasi'] as $kat)
                        <option value="{{ $kat }}" @selected(old('kategori') === $kat)>{{ $kat }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Brand</label>
                <input type="text" name="brand" value="{{ old('brand') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Kompatibilitas Kendaraan</label>
                <input type="text" name="kompatibilitas_kendaraan" value="{{ old('kompatibilitas_kendaraan') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Harga</label>
                <input type="number" name="harga" value="{{ old('harga') }}" class="w-full border rounded px-3 py-2" required min="0">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Stok</label>
                <input type="number" name="stok" value="{{ old('stok') }}" class="w-full border rounded px-3 py-2" required min="0">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">URL Gambar</label>
                <input type="text" name="gambar" value="{{ old('gambar') }}" class="w-full border rounded px-3 py-2" placeholder="Upload file gambar menyusul, sementara pakai URL dulu">
            </div>

            <div class="flex gap-2 pt-4">
                <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded">Simpan</button>
                <a href="{{ route('admin.produk.index') }}" class="px-6 py-2 border rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
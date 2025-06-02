@extends('layouts.main')

@section('title', 'Tambah Barang')

@section('content')
    <h1>Tambah Barang Baru</h1>

    <form action="{{ route('barang') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <label for="id_category">Kategori Barang</label>
        <select name="id_category" id="id_category" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategori as $kat)
                <option value="{{ $kat->id_category }}" {{ old('id_category') == $kat->id_category ? 'selected' : '' }}>
                    {{ $kat->nama_kategori }}
                </option>
            @endforeach
        </select>
        @error('id_category') <div class="error-message">{{ $message }}</div> @enderror

        <label for="kode_barang">Kode Barang</label>
        <input type="text" id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}" required />
        @error('kode_barang') <div class="error-message">{{ $message }}</div> @enderror

        <label for="nama_barang">Nama Barang</label>
        <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required />
        @error('nama_barang') <div class="error-message">{{ $message }}</div> @enderror

        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" value="{{ old('stock') }}" min="0" required />
        @error('stock') <div class="error-message">{{ $message }}</div> @enderror

        <label for="brand">Brand</label>
        <input type="text" id="brand" name="brand" value="{{ old('brand') }}" />
        @error('brand') <div class="error-message">{{ $message }}</div> @enderror

        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="">-- Pilih Status --</option>
            <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
            <option value="dipinjam" {{ old('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
        </select>
        @error('status') <div class="error-message">{{ $message }}</div> @enderror

        <label for="kondisi_barang">Kondisi Barang</label>
        <select id="kondisi_barang" name="kondisi_barang">
            <option value="">-- Pilih Kondisi --</option>
            <option value="baik" {{ old('kondisi_barang') == 'baik' ? 'selected' : '' }}>Baik</option>
            <option value="rusak" {{ old('kondisi_barang') == 'rusak' ? 'selected' : '' }}>Rusak</option>
            <option value="dll" {{ old('kondisi_barang') == 'dll' ? 'selected' : '' }}>DLL</option>
        </select>
        @error('kondisi_barang') <div class="error-message">{{ $message }}</div> @enderror

        <label for="gambar_barang">Gambar Barang</label>
        <input type="file" id="gambar_barang" name="gambar_barang" accept="image/*" />
        @error('gambar_barang') <div class="error-message">{{ $message }}</div> @enderror

        <button type="submit">Simpan</button>
    </form>
@endsection

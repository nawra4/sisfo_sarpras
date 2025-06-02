@extends('layouts.main')

@section('title', 'Edit Barang')

@section('content')
    <h1>Edit Barang</h1>

    <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        <label for="id_category">Kategori Barang</label>
        <select name="id_category" id="id_category" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategori as $kat)
                <option value="{{ $kat->id_category }}" {{ (old('id_category', $barang->id_category) == $kat->id_category) ? 'selected' : '' }}>
                    {{ $kat->nama_kategori }}
                </option>
            @endforeach
        </select>
        @error('id_category') <div class="error-message">{{ $message }}</div> @enderror

        <label for="kode_barang">Kode Barang</label>
        <input type="text" id="kode_barang" name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}" required />
        @error('kode_barang') <div class="error-message">{{ $message }}</div> @enderror

        <label for="nama_barang">Nama Barang</label>
        <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required />
        @error('nama_barang') <div class="error-message">{{ $message }}</div> @enderror

        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" value="{{ old('stock', $barang->stock) }}" min="0" required />
        @error('stock') <div class="error-message">{{ $message }}</div> @enderror

        <label for="brand">Brand</label>
        <input type="text" id="brand" name="brand" value="{{ old('brand', $barang->brand) }}" />
        @error('brand') <div class="error-message">{{ $message }}</div> @enderror

        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="">-- Pilih Status --</option>
            <option value="tersedia" {{ old('status', $barang->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
            <option value="dipinjam" {{ old('status', $barang->status) == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
        </select>
        @error('status') <div class="error-message">{{ $message }}</div> @enderror

        <label for="kondisi_barang">Kondisi Barang</label>
        <select id="kondisi_barang" name="kondisi_barang">
            <option value="">-- Pilih Kondisi --</option>
            <option value="baik" {{ old('kondisi_barang', $barang->kondisi_barang) == 'baik' ? 'selected' : '' }}>Baik</option>
            <option value="rusak" {{ old('kondisi_barang', $barang->kondisi_barang) == 'rusak' ? 'selected' : '' }}>Rusak</option>
            <option value="dll" {{ old('kondisi_barang', $barang->kondisi_barang) == 'dll' ? 'selected' : '' }}>DLL</option>
        </select>
        @error('kondisi_barang') <div class="error-message">{{ $message }}</div> @enderror

        <label for="gambar_barang">Gambar Barang</label>
        <input type="file" id="gambar_barang" name="gambar_barang" accept="image/*" />
        @if($barang->gambar_barang)
            <img src="{{ asset('storage/gambar_barang/'.$barang->gambar_barang) }}" alt="Gambar Barang" style="width: 80px; border-radius: 8px; margin-bottom: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
        @endif
        @error('gambar_barang') <div class="error-message">{{ $message }}</div> @enderror

        <button type="submit">Update</button>
    </form>
@endsection

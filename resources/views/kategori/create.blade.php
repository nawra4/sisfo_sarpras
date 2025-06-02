@extends('layouts.main')

@section('title', 'Tambah Kategori')

@section('content')
    <h1>Tambah Kategori Baru</h1>

    <form action="{{ route('kategori.store') }}" method="POST" novalidate>
        @csrf

        <label for="nama_kategori">Nama Kategori</label>
        <input type="text" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}" required />
        @error('nama_kategori') <div class="error-message">{{ $message }}</div> @enderror

        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="4" style="resize: vertical;">{{ old('deskripsi') }}</textarea>
        @error('deskripsi') <div class="error-message">{{ $message }}</div> @enderror

        <button type="submit">Simpan</button>
    </form>
@endsection

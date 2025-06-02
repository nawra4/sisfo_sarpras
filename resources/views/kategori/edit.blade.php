@extends('layouts.main')

@section('title', 'Edit Kategori')

@section('content')
    <h1>Edit Kategori</h1>

    <form action="{{ route('kategori.update', $kategori->id_category) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <label for="nama_kategori">Nama Kategori</label>
        <input type="text" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required />
        @error('nama_kategori') <div class="error-message">{{ $message }}</div> @enderror

        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="4" style="resize: vertical;">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
        @error('deskripsi') <div class="error-message">{{ $message }}</div> @enderror

        <button type="submit">Update</button>
    </form>
@endsection

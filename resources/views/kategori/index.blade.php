@extends('layouts.main')

@section('title', 'Daftar Kategori')

@section('content')
    <h1>Daftar Kategori Barang</h1>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <a href="{{ route('kategori.create') }}" class="btn btn-success" style="margin-bottom: 20px; display: inline-block;">Tambah Kategori Baru</a>

    <table>
        <thead>
            <tr>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategori as $kat)
                <tr>
                    <td>{{ $kat->nama_kategori }}</td>
                    <td>{{ $kat->deskripsi ?? '-' }}</td>
                    <td>
                        <a href="{{ route('kategori.edit', $kat->id_category) }}" class="btn btn-primary" style="margin-right: 8px;">Edit</a>
                        <form action="{{ route('kategori.destroy', $kat->id_category) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin hapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" style="text-align:center; color:#ccc;">Data kategori tidak tersedia</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection

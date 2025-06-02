@extends('layouts.main')

@section('title', 'Daftar Barang')

@section('content')
    <h1>Daftar Barang</h1>

    <a href="{{ route('barang.create') }}" class="btn btn-success" style="margin-bottom: 20px; display: inline-block;">Tambah Barang</a>

    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stock</th>
                <th>Brand</th>
                <th>Status</th>
                <th>Kondisi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barang as $item)
                <tr>
                    <td>{{ $item->kode_barang }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>{{ $item->brand ?? '-' }}</td>
                    <td>{{ ucfirst($item->status ?? '-') }}</td>
                    <td>{{ ucfirst($item->kondisi_barang ?? '-') }}</td>
                    <td>
                        @if($item->gambar_barang)
                            <img src="{{ asset('storage/gambar_barang/'.$item->gambar_barang) }}" alt="Gambar {{ $item->nama_barang }}" style="width: 60px; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                        @else
                            <span style="color: #bbb;">-</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('barang.edit', $item->id_barang) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin ingin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="9" style="text-align:center; color: #ccc;">Data barang tidak tersedia</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection

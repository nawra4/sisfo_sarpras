{{-- resources/views/laporan/pdf/pengembalian.blade.php --}}
@extends('layouts.main')

@section('title', 'Laporan Pengembalian')

@section('content')
    <h1>Laporan Pengembalian</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Peminjam</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->peminjaman->user->name ?? '-' }}</td>
                    <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                    <td>{{ $item->jumlah }} Item</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

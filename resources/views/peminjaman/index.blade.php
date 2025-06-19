@extends('layouts.main')

@section('title', 'Daftar Peminjaman')

@section('content')
    <h1>Daftar Peminjaman</h1>
    <table>
        <thead>
            <tr>
                <th>ID Peminjaman</th>
                <th>User</th>
                <th>Nama Barang</th>
                <th>Keperluan</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
    @forelse ($peminjaman as $pinjam)
        <tr>
            <td>{{ $pinjam->id_peminjaman }}</td>
            <td>{{ $pinjam->user->username ?? '-' }}</td>
            <td>{{ $pinjam->detail->barang->nama_barang ?? '-' }}</td>
            <td>{{ $pinjam->detail->keperluan ?? '-' }}</td>
            <td>{{ $pinjam->detail->jumlah ?? '-' }}</td> {{-- Ini jumlah --}}
            <td style="text-transform: capitalize;">{{ $pinjam->status }}</td> {{-- Ini status --}}
            <td>{{ \Carbon\Carbon::parse($pinjam->detail->tanggal_pinjam)->format('d M Y') ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($pinjam->detail->tanggal_kembali)->format('d M Y') ?? '-' }}</td> {{-- Fix ini --}}
            <td>
                @if($pinjam->status === 'pending')
                    <div style="display: flex; gap: 8px;">
                        <form action="{{ route('peminjaman.approve', $pinjam->id_peminjaman) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <form action="{{ route('peminjaman.reject', $pinjam->id_peminjaman) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                    </div>
                @else
                    <span style="font-weight:600;">{{ ucfirst($pinjam->status) }}</span>
                @endif
            </td>
        </tr>
    @empty
        <tr><td colspan="9" style="text-align:center;">Belum ada data peminjaman</td></tr>
    @endforelse
</tbody>
    </table>
@endsection

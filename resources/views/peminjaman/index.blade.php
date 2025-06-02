@extends('layouts.main')

@section('title', 'Daftar Peminjaman')

@section('content')
    <h1>Daftar Peminjaman</h1>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert-error" style="background: #e53e3e; padding: 14px 20px; border-radius: 12px; font-weight: 600; color: white; text-align:center; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID Peminjaman</th>
                <th>User</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Keperluan</th>
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
                    <td>{{ $pinjam->detail->jumlah ?? '-' }}</td>
                    <td>{{ $pinjam->detail->keperluan ?? '-' }}</td>
                    <td style="text-transform: capitalize;">{{ $pinjam->status }}</td>
                    <td>{{ \Carbon\Carbon::parse($pinjam->detail->tanggal_pinjam)->format('d M Y') ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($pinjam->detail->tanggal_kembali)->format('d M Y') ?? '-' }}</td>
                    <td>
                        @if($pinjam->status === 'pending')
                            <form action="{{ route('peminjaman.approve', $pinjam->id_peminjaman) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success" style="margin-right:6px;">Approve</button>
                            </form>
                            <form action="{{ route('peminjaman.reject', $pinjam->id_peminjaman) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
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

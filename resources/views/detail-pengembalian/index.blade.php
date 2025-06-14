@extends('layouts.main')

@section('title', 'Detail Pengembalian')

@section('content')
    <h1>Detail Pengembalian</h1>
    <table>
        <thead>
            <tr>
                <th>ID Detail</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Pengembalian</th>
                <th>Kondisi</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $detail)
                <tr>
                    <td>{{ $detail->id_detail_pengembalian }}</td>
                    <td>{{ $detail->barang->nama_barang ?? '-' }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>{{ \Carbon\Carbon::parse($detail->tanggal_pengembalian)->format('d M Y') }}</td>
                    <td>{{ ucfirst($detail->kondisi ?? '-') }}</td>
                    <td>{{ $detail->keterangan ?? '-' }}</td>
                    <td style="text-transform: capitalize;">{{ $detail->status ?? 'pending' }}</td>
                    <td>
                        @if($detail->item_image)
                            <img src="{{ asset('storage/'.$detail->item_image) }}" alt="Gambar Barang" style="width: 60px; border-radius: 6px;">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($detail->status !== 'approve')
                        <div style="display: flex; gap:8px;">
                            <form action="{{ route('detail-pengembalian.approve', $detail->id_detail_pengembalian) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success" style="margin-right:6px;">Approve</button>
                            </form>
                            <form action="{{ route('detail-pengembalian.reject', $detail->id_detail_pengembalian) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                            </div>
                        @else
                            <span style="font-weight:600; color: #48bb78;">Disetujui</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="9" style="text-align:center;">Belum ada data pengembalian</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection

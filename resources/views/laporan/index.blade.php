{{-- resources/views/laporan/index.blade.php --}}
@extends('layouts.main')

@section('title', 'Laporan')

@section('content')
    <h1>Laporan</h1>

    <div class="grid-dashboard">
        <div class="dashboard-card blue">
            <h2>{{ $totalBarang }}</h2>
            <p>Total Barang</p>
        </div>
        <div class="dashboard-card green">
            <h2>{{ $barangTersedia }}</h2>
            <p>Barang Tersedia</p>
        </div>
        <div class="dashboard-card orange">
            <h2>{{ $totalPeminjaman }}</h2>
            <p>Total Peminjaman</p>
        </div>
        <div class="dashboard-card blue">
            <h2>{{ $peminjamanAktif }}</h2>
            <p>Peminjaman Aktif</p>
        </div>
        <div class="dashboard-card green">
            <h2>{{ $totalPengembalian }}</h2>
            <p>Total Pengembalian</p>
        </div>
    </div>

    <div class="export-buttons">
        <h3>Export Laporan</h3>
        <div class="button-group">
            <a href="{{ route('laporan.barang.pdf') }}" class="btn btn-primary">Export Barang to PDF</a>
            <a href="{{ route('laporan.barang.excel') }}" class="btn btn-success">Export Barang to Excel</a>
        </div>

        <div class="button-group">
            <a href="{{ route('laporan.peminjaman.pdf') }}" class="btn btn-primary">Export Peminjaman to PDF</a>
            <a href="{{ route('laporan.peminjaman.excel') }}" class="btn btn-success">Export Peminjaman to Excel</a>
        </div>

        <div class="button-group">
            <a href="{{ route('laporan.pengembalian.pdf') }}" class="btn btn-primary">Export Pengembalian to PDF</a>
            <a href="{{ route('laporan.pengembalian.excel') }}" class="btn btn-success">Export Pengembalian to Excel</a>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .export-buttons {
            margin-top: 40px;
            text-align: center;
        }

        .button-group {
            margin-bottom: 20px;
        }

        .button-group a {
            display: inline-block;
            margin: 10px 15px;
        }

        .export-buttons h3 {
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: #f7fafc;
        }
    </style>
@endpush

@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard Overview</h1>

    <div class="grid-dashboard">
        <div class="dashboard-card">
            <h2>{{ $totalBarang }}</h2>
            <p>Total Barang</p>
        </div>

        <div class="dashboard-card">
            <h2>{{ $totalUsers }}</h2>
            <p>Total Users</p>
        </div>

        <div class="dashboard-card">
            <h2>{{ $totalPeminjaman }}</h2>
            <p>Total Peminjaman</p>
        </div>

        <div class="dashboard-card orange">
            <h2>{{ $totalPeminjamanPending }}</h2>
            <p>Peminjaman Pending</p>
        </div>

        <div class="dashboard-card green">
            <h2>{{ $totalPeminjamanDipinjam }}</h2>
            <p>Peminjaman Dipinjam</p>
        </div>

        <div class="dashboard-card blue">
            <h2>{{ $totalPengembalian }}</h2>
            <p>Pengembalian Disetujui</p>
        </div>
    </div>
@endsection

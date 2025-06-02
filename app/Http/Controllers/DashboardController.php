<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\DetailPengembalian;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data summary
        $totalBarang = Barang::count();
        $totalUsers = User::count();
        $totalPeminjaman = Peminjaman::count();
        $totalPeminjamanPending = Peminjaman::where('status', 'pending')->count();
        $totalPeminjamanDipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $totalPengembalian = DetailPengembalian::where('status', 'approve')->count();

        return view('dashboard.index', compact(
            'totalBarang',
            'totalUsers',
            'totalPeminjaman',
            'totalPeminjamanPending',
            'totalPeminjamanDipinjam',
            'totalPengembalian'
        ));
    }
}

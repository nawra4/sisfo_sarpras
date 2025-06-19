<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailPeminjaman;
use App\Models\DetailPengembalian;
use App\Models\KategoriBarang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use PDF; // Pastikan package ini sudah diinstal dan dikonfigurasi
use Excel; // Pastikan package ini sudah diinstal dan dikonfigurasi
use App\Exports\BarangExport; // Pastikan export classes ini sudah dibuat
use App\Exports\PeminjamanExport;
use App\Exports\PengembalianExport;
use Carbon\Carbon; // Pastikan ini diimpor
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $barangTersedia = Barang::where('status', 'Tersedia')->count();
        $totalPeminjaman = DetailPeminjaman::count();
        $peminjamanAktif = DetailPeminjaman::where('status', 'pending')->count();
        $totalPengembalian = DetailPengembalian::where('soft_delete', 0)->count();
        $kategoriList = KategoriBarang::all();

        $recentPeminjaman = DetailPeminjaman::with(['user', 'barang'])->latest()->take(5)->get()->map(function ($item) {
            return [
                'judul' => 'Peminjaman ' . optional($item->user)->name,
                'oleh' => optional($item->user)->username ?? '-',
                'jumlah' => $item->jumlah . ' Item',
                // PERBAIKAN DI SINI
                'tanggal' => optional(Carbon::parse($item->tanggal_pinjam))->translatedFormat('d M Y') ?? '-',
            ];
        });

        $recentPengembalian = DetailPengembalian::with(['peminjaman.user', 'barang'])->latest()->take(5)->get()->map(function ($item) {
            return [
                'judul' => 'Pengembalian ' . optional(optional($item->peminjaman)->user)->name,
                'oleh' => optional(optional($item->peminjaman)->user)->username ?? '-',
                'jumlah' => $item->jumlah . ' Item',
                // PERBAIKAN DI SINI
                'tanggal' => optional(Carbon::parse($item->tanggal_pengembalian))->translatedFormat('d M Y') ?? '-',
            ];
        });

        $inventoryData = Barang::with('kategori')->latest()->take(10)->get()->map(function ($item) {
            return [
                'kode' => $item->kode_barang,
                'nama' => $item->nama_barang,
                'kategori' => optional($item->kategori)->nama_kategori ?? '-',
                'jumlah' => $item->stock,
                'kondisi' => ucfirst($item->kondisi_barang),
                // PERBAIKAN DI SINI
                'tanggal' => optional($item->created_at)->format('d/m/Y') ?? '-',
                'gambar' => $item->gambar_barang,
            ];
        });

        $chartData = collect([
            ['name' => 'Jan', 'value' => 45],
            ['name' => 'Feb', 'value' => 63],
            ['name' => 'Mar', 'value' => 58],
            ['name' => 'Apr', 'value' => 75],
            ['name' => 'May', 'value' => 10],
        ]);

        // Create empty peminjaman collection as default
        $peminjaman = collect();

        // Set default values for filter parameters
        $startDate = null;
        $endDate = null;
        $kategori = null;

        return view('laporan.index', compact(
            'totalBarang', 'barangTersedia',
            'totalPeminjaman', 'peminjamanAktif',
            'totalPengembalian',
            'kategoriList', 'recentPeminjaman',
            'recentPengembalian', 'inventoryData',
            'chartData', 'peminjaman', 'startDate', 'endDate', 'kategori'
        ));
    }

    // The rest of your methods remain unchanged...
    // ---------------- BARANG ----------------
    public function barang(Request $request)
    {
        $query = Barang::with('kategori');
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
        $data = $query->get();
        return view('laporan.pdf.barang', compact('data'));
    }

    public function barangPdf(Request $request)
    {
        $query = Barang::with('kategori');
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
        $data = $query->get();
        $pdf = PDF::loadView('laporan.pdf.barang', compact('data'));
        return $pdf->download('laporan_barang.pdf');
    }

    public function barangExcel(Request $request)
    {
        return Excel::download(new BarangExport($request->start_date, $request->end_date), 'laporan_barang.xlsx');
    }

    // ---------------- PEMINJAMAN ----------------
    public function peminjaman(Request $request)
    {
        $query = DetailPeminjaman::with(['barang', 'user']);
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('tanggal_pinjam', [$request->start_date, $request->end_date]);
        }
        $data = $query->get();
        return view('laporan.pdf.peminjaman', compact('data'));
    }

    public function peminjamanPdf(Request $request)
    {
        $query = Peminjaman::with(['user', 'detail.barang']);
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereHas('detail', function ($q) use ($request) {
                $q->whereBetween('tanggal_pinjam', [$request->start_date, $request->end_date]);
            });
        }
        $data = $query->get();
        $pdf = PDF::loadView('laporan.pdf.peminjaman', compact('data'));
        return $pdf->download('laporan_peminjaman.pdf');
    }

    public function peminjamanExcel(Request $request)
    {
        return Excel::download(new PeminjamanExport($request->start_date, $request->end_date), 'laporan_peminjaman.xlsx');
    }

    // ---------------- PENGEMBALIAN ----------------
    public function pengembalian(Request $request)
    {
        $query = DetailPengembalian::with(['barang', 'peminjaman.user'])->where('soft_delete', 0);
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('tanggal_kembali', [$request->start_date, $request->end_date]);
        }
        $data = $query->get();
        return view('laporan.pdf.pengembalian', compact('data'));
    }

    public function pengembalianPdf(Request $request)
    {
        $query = DetailPengembalian::with(['barang', 'peminjaman.user'])->where('soft_delete', 0);
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('tanggal_kembali', [$request->start_date, $request->end_date]);
        }
        $data = $query->get();
        $pdf = PDF::loadView('laporan.pdf.pengembalian', compact('data'));
        return $pdf->download('laporan_pengembalian.pdf');
    }

    public function pengembalianExcel(Request $request)
    {
        return Excel::download(new PengembalianExport($request->start_date, $request->end_date), 'laporan_pengembalian.xlsx');
    }
}

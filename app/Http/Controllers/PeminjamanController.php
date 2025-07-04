<?php

namespace App\Http\Controllers;

use App\Http\Resources\PeminjamanRes;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PeminjamanController extends Controller
{
    public function index()
    {
        try {
            $peminjaman = Peminjaman::with(['user', 'detail.barang'])
                ->orderBy('created_at', 'desc')
                ->get();

            Log::info('Total peminjaman found:', ['count' => $peminjaman->count()]);

            foreach ($peminjaman as $index => $pinjam) {
                Log::info("Peminjaman #{$index}:", [
                    'id' => $pinjam->id_peminjaman,
                    'users_id' => $pinjam->users_id,
                    'id_detail_peminjaman' => $pinjam->id_detail_peminjaman ?? 'null',
                    'user_exists' => $pinjam->user ? true : false,
                    'user_username' => $pinjam->user?->username ?? 'null',
                    'detail_exists' => $pinjam->detail ? true : false,
                    'status' => $pinjam->status,
                ]);

                if ($pinjam->detail) {
                    Log::info("Detail info:", [
                        'id_detail' => $pinjam->detail->id_detail_peminjaman ?? 'null',
                        'barang_exists' => $pinjam->detail->barang ? true : false,
                        'nama_barang' => $pinjam->detail->barang?->nama_barang ?? 'null',
                        'keperluan' => $pinjam->detail->keperluan ?? 'null',
                        'jumlah' => $pinjam->detail->jumlah ?? 'null',
                    ]);
                }
            }

            return view('peminjaman.index', compact('peminjaman'));

        } catch (\Exception $e) {
            Log::error('Error in peminjaman index:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([], 500);
        }
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['user', 'detail.barang'])->findOrFail($id);
        return response()->json($peminjaman);
    }

    public function getPeminjamanByIdUsers($id) {
        $user = User::where('users_id', $id)->first();
        $peminjamanByUsers = Peminjaman::where('users_id', $user->users_id)->get();

        return response()->json(PeminjamanRes::collection($peminjamanByUsers));
    }

    public function store(Request $request)
{
    $user = Auth::user();

    try {
        $validator = Validator::make($request->all(), [
            'id_barang' => 'required|exists:barang,id_barang',
            'jumlah' => 'required|integer|min:1',
            'keperluan' => 'required|string',
            'class' => 'required|string',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        if ($validator->fails()) {
            Log::error('Validasi gagal saat peminjaman', $validator->errors()->toArray());
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Buat detail_peminjaman
        $detailPeminjaman = DetailPeminjaman::create([
            'users_id' => $user->users_id,
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
            'keperluan' => $request->keperluan,
            'class' => $request->class,
            'status' => 'pending',
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        // Buat peminjaman
        $peminjaman = Peminjaman::create([
            'users_id' => $user->users_id,
            'id_detail_peminjaman' => $detailPeminjaman->id_detail_peminjaman,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil diajukan.',
            'data' => $peminjaman->load(['user', 'detail.barang']),
        ], 201);

    } catch (\Exception $e) {
        Log::error('Gagal menyimpan peminjaman:', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'request_data' => $request->all(),
        ]);
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan server saat membuat peminjaman.',
        ], 500);
    }
}

    public function approve($id)
    {
        try {
        Log::info("Approve peminjaman with ID: $id");

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'dipinjam';
        $peminjaman->save();

        Log::info("Peminjaman approved successfully:", [
            'id' => $id,
            'new_status' => $peminjaman->status
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil disetujui!');
    } catch (\Exception $e) {
        Log::error("Error approving peminjaman:", [
            'id' => $id,
            'error' => $e->getMessage()
        ]);

        return redirect()->route('peminjaman.index')->with('error', 'Gagal menyetujui peminjaman!');
    }
}

    public function reject($id)
    {
        try {
        Log::info("Reject peminjaman with ID: $id");

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'rejected';
        $peminjaman->save();

        Log::info("Peminjaman rejected successfully:", [
            'id' => $id,
            'new_status' => $peminjaman->status
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditolak!');
    } catch (\Exception $e) {
        Log::error("Error rejecting peminjaman:", [
            'id' => $id,
            'error' => $e->getMessage()
        ]);

        return redirect()->route('peminjaman.index')->with('error', 'Gagal menolak peminjaman!');
    }
}

    public function userPeminjaman()
    {
        try {
            $userId = Auth::id(); // Mengambil ID user yang sedang login
            $peminjaman = Peminjaman::with(['user', 'detail.barang'])
                ->where('users_id', $userId)
                ->orderBy('created_at', 'desc')
                ->get();

            Log::info('Total peminjaman for user $userId found:', ['count' => $peminjaman->count()]);

            foreach ($peminjaman as $index => $pinjam) {
                Log::info("Peminjaman #{$index}:", [
                    'id' => $pinjam->id_peminjaman,
                    'users_id' => $pinjam->users_id,
                    'id_detail_peminjaman' => $pinjam->id_detail_peminjaman ?? 'null',
                    'user_exists' => $pinjam->user ? true : false,
                    'user_username' => $pinjam->user?->username ?? 'null',
                    'detail_exists' => $pinjam->detail ? true : false,
                    'status' => $pinjam->status,
                ]);

                if ($pinjam->detail) {
                    Log::info("Detail info:", [
                        'id_detail' => $pinjam->detail->id_detail_peminjaman ?? 'null',
                        'barang_exists' => $pinjam->detail->barang ? true : false,
                        'nama_barang' => $pinjam->detail->barang?->nama_barang ?? 'null',
                        'keperluan' => $pinjam->detail->keperluan ?? 'null',
                        'jumlah' => $pinjam->detail->jumlah ?? 'null',
                    ]);
                }
            }

            return response()->json($peminjaman);

        } catch (\Exception $e) {
            Log::error('Error in user peminjaman:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([], 500);
        }
    }
}

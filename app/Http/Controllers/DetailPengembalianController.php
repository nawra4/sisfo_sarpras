<?php

namespace App\Http\Controllers;

use App\Http\Resources\PengembalianRes;
use App\Models\DetailPengembalian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class DetailPengembalianController extends Controller
{
    // Tampilkan semua data detail pengembalian
    public function index()
    {
        $data = DetailPengembalian::with('barang', 'peminjaman', 'detailPeminjaman')->where('soft_delete', 0)->get();
        return view('detail-pengembalian.index', compact('data'));
    }

    // Simpan data detail pengembalian baru
    public function store(Request $request)
    {
        $user = Auth::user();

        $validate = $request->validate([
            'id_detail_peminjaman' => 'required|exists:detail_peminjaman,id_detail_peminjaman',
            'id_peminjaman' => 'required|exists:peminjaman,id_peminjaman',
            'id_barang' => 'required|exists:barang,id_barang',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'item_image' => 'nullable|string',
        ]);

        $detail = DetailPengembalian::create([
            'users_id' => $user->users_id,
            'id_detail_peminjaman' => $validate['id_detail_peminjaman'],
            'id_peminjaman' => $validate['id_peminjaman'],
            'id_barang' => $validate['id_barang'],
            'jumlah' => $validate['jumlah'],
            'tanggal_pengembalian' => Date::now(),
            'kondisi' => $validate['kondisi'],
            'keterangan' => $validate['keterangan'],
            'item_image' => $validate['item_image'],
        ]);

        return response()->json([
            'message' => 'Data detail pengembalian berhasil disimpan.',
            'data' => $detail
        ], 201);
    }

    // Tampilkan detail pengembalian berdasarkan ID
    public function show($id)
    {
        $detail = DetailPengembalian::with('barang', 'peminjaman', 'detailPeminjaman')->findOrFail($id);
        return response()->json($detail);
    }

    public function detailPengembalianByUsers($id) {
        $user = User::where('users_id', $id)->first();
        $getPengembalianByUser = DetailPengembalian::where('users_id', $user->users_id)->get();

        return response()->json(PengembalianRes::collection($getPengembalianByUser));
    }

    // Update data detail pengembalian
    public function update(Request $request, $id)
    {
        $detail = DetailPengembalian::findOrFail($id);

        $request->validate([
            'jumlah' => 'nullable|integer|min:1',
            'kondisi' => 'nullable|string',
            'tanggal_pengembalian' => 'nullable|date',
            'keterangan' => 'nullable|string',
            'item_image' => 'nullable|string',
        ]);

        $detail->update($request->all());

        return response()->json([
            'message' => 'Data detail pengembalian berhasil diperbarui.',
            'data' => $detail
        ]);
    }

    // Soft delete
    public function destroy($id)
    {
        $detail = DetailPengembalian::findOrFail($id);
        $detail->soft_delete = 1;
        $detail->save();

        return response()->json([
            'message' => 'Data berhasil dihapus (soft delete).'
        ]);
    }

    // Approve pengembalian
    public function approve($id)
    {
        $detail = DetailPengembalian::findOrFail($id);
        $detail->status = 'approve';
        $detail->save();

        return redirect()->back()->with('success', 'Pengembalian telah disetujui!');
    }

    // Reject pengembalian
    public function reject($id)
    {
        $detail = DetailPengembalian::findOrFail($id);
        $detail->status = 'not approve';
        $detail->save();

        return redirect()->back()->with('error', 'Pengembalian telah ditolak!');
    }
}

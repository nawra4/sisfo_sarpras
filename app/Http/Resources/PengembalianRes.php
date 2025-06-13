<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PengembalianRes extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_detail_pengembalian' => $this->id_detail_pengembalian,
            'users_id' => new UserRes($this->user),
            'id_detail_peminjaman' => new DetailPeminjamanRes($this->detailPeminjaman),
            'id_peminjaman' => new PeminjamanRes($this->peminjaman),
            'id_barang' => new BarangRes($this->barang),
            'jumlah' => $this->jumlah,
            'kondisi' => $this->kondisi,
            'soft_delete' => $this->soft_delete,
            'status' => $this->status,
            'tanggal_pengembalian' => $this->tanggal_pengembalian,
            'keterangan' => $this->keterangan,
            'item_image' => $this->item_image,
        ];
    }
}

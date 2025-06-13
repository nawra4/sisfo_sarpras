<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailPeminjamanRes extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_detail_peminjaman' => $this->id_detail_peminjaman,
            'users_id' => new UserRes($this->user),
            'id_barang' => new BarangRes($this->barang),
            'jumlah' => $this->jumlah,
            'keperluan' => $this->keperluan,
            'class' => $this->class,
            'status' => $this->status,
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali
        ];
    }
}

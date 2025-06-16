<?php

namespace App\Http\Resources;

use App\Models\DetailPeminjaman;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PeminjamanRes extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_peminjaman' => $this->id_peminjaman,
            'users_id' => new UserRes($this->user),
            'id_detail_peminjaman' => new DetailPeminjamanRes($this->detail),
            'status' => $this->status,
            'keperluan' => $this->keperluan
        ];
    }
}

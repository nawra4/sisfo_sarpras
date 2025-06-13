<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BarangRes extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_barang' => $this->id_barang,
            'id_category' => $this->id_category,
            'kode_barang' => $this->kode_barang,
            'nama_barang' => $this->nama_barang,
            'stock' => $this->stock,
            'brand' => $this->brand,
            'status' => $this->status,
            'kondisi_barang' => $this->kondisi_barang,
            'gambar_barang' => $this->gambar_barang 
        ];
    }
}

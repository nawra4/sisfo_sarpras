<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengembalian extends Model
{
    use HasFactory;

    protected $table = 'detail_pengembalian';
    protected $primaryKey = 'id_detail_pengembalian';

    protected $fillable = [
        'id_detail_peminjaman',
        'users_id',
        'id_peminjaman',
        'id_barang',
        'jumlah',
        'kondisi',
        'soft_delete',
        'tanggal_pengembalian',
        'keterangan', 
        'item_image',
    ];

    public function detailPeminjaman()
    {
        return $this->belongsTo(DetailPeminjaman::class, 'id_detail_peminjaman', 'id_detail_peminjaman');
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'users_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
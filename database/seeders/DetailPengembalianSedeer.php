<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailPengembalianSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_pengembalian')->insert([
            'users_id' => 1,
            'id_detail_peminjaman' => 1,
            'id_peminjaman' => 1,
            'id_barang' => 1,
            'jumlah' => 2,
            'kondisi' => 'Baik',
            'status' => 'pending',
            'soft_delete' => 0,
            'tanggal_pengembalian' => Carbon::now(),
            'keterangan' => 'Tidak ada kerusakan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('detail_pengembalian')->insert([
            'users_id' => 2,
            'id_detail_peminjaman' => 2,
            'id_peminjaman' => 2,
            'id_barang' => 2,
            'jumlah' => 1,
            'kondisi' => 'Rusak ringan',
            'status' => 'pending',
            'soft_delete' => 0,
            'tanggal_pengembalian' => Carbon::now()->addDay(),
            'keterangan' => 'Bagian casing tergores',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

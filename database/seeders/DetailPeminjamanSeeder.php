<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailPeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_peminjaman')->insert([
            'users_id' => 1,
            'id_barang' => 1,
            'jumlah' => 2,
            'keperluan' => 'Praktikum Fisika',
            'class' => 'XII IPA 1',
            'status' => 'pending',
            'tanggal_pinjam' => Carbon::now()->subDays(2),
            'tanggal_kembali' => Carbon::now()->addDays(3),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

         DB::table('detail_peminjaman')->insert([
            'users_id' => 2,
            'id_barang' => 2,
            'jumlah' => 1,
            'keperluan' => 'Proyek Sains',
            'class' => 'XI IPA 2',
            'status' => 'pending',
            'tanggal_pinjam' => Carbon::now(),
            'tanggal_kembali' => Carbon::now()->addDays(5),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

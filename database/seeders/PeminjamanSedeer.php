<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('peminjaman')->insert([
            'users_id' => 1,
            'id_detail_peminjaman' => 1, 
            'status' => 'pending',
            'keperluan' => 'Praktikum Fisika',
            'soft_delete' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('peminjaman')->insert([
            'users_id' => 2,
            'id_detail_peminjaman' => 2, 
            'status' => 'pending',
            'keperluan' => 'Proyek Sains',
            'soft_delete' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

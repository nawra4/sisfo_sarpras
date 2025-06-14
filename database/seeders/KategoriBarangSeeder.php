<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('kategori_barang')->insert([
            'nama_kategori' => 'Elektronik',
            'deskripsi' => 'Barang- barang elektronik',
        ]);

        DB::table('kategori_barang')->insert([
            'nama_kategori' => 'ATK',
            'deskripsi' => 'alat tulis kantor'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barang')->insert([
            'id_barang' => 1,
            'kode_barang' => 'ELK001',
            'nama_barang' => 'Proyektor',
            'id_category' => 1,
            'stock' => 1,
            'brand' => 'Epson',
            'kondisi_barang' => 'Baik',
            'status' => 'tersedia'
        ]);
        DB::table('barang')->insert([
            'id_barang' => 2,
            'kode_barang' => 'ATK001',
            'nama_barang' => 'Spidol',
            'id_category' => 2,
            'stock' => 10,
            'brand' => 'Stabilo',
            'kondisi_barang' => 'baik',
            'status' => 'tersedia'
        ]);
    }
}

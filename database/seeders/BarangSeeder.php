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
            'kode_barang'    => 'BRG-001',
            'nama_barang'    => 'Laptop Lenovo Thinkpad',
            'id_category' => 1,
            'stock'          => 10,
            'brand'          => 'Lenovo',
            'status'         => 'tersedia',
            'kondisi_barang' => 'baik',
            'gambar_barang'  => 'lenovo.jpg',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }
}

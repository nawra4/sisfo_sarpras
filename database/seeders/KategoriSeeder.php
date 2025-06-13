<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_barang')->insert([
            [
                'nama_kategori' => 'Elektronik',
                'deskripsi'     => 'Peralatan elektronik seperti laptop, proyektor, dan lainnya.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nama_kategori' => 'Perlengkapan Kelas',
                'deskripsi'     => 'Barang-barang seperti papan tulis, spidol, dan kursi.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}

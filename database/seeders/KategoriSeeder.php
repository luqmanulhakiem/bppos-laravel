<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // List Kategori
        $arrayKategori = [
            ['id' => 1, 'nama' => 'Mesin Besar'],
            ['id' => 2, 'nama' => 'Mesin A3'],
            ['id' => 3, 'nama' => 'Cutting'],
        ];

        // membuat list supplier sebanyak list diatas
        Kategori::insert($arrayKategori);
    }
}

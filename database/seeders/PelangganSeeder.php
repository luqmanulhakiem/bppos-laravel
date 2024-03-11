<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // List Pelanggan
         $arrayPelanggan = [
            ['id' => 1, 'nama' => 'Devi','gender' => 'P','telp' => '12231', 'alamat' => 'Jl. Suka Maju', 'level' => '3'],
            ['id' => 2, 'nama' => 'Laily','gender' => 'P','telp' => '1233231', 'alamat' => 'Jl. Suka Jalan', 'level' => '5'],
        ];

        // membuat list supplier sebanyak list diatas
        Pelanggan::insert($arrayPelanggan);
    }
}

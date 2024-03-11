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
        
        //  Buat Pelanggan
        $arrayPelanggan = [
            ['nama' => 'Devi','gender' => 'P','telp' => '12231', 'alamat' => 'Jl. Suka Maju', 'level' => '3'],
            ['nama' => 'Laily','gender' => 'P','telp' => '1233231', 'alamat' => 'Jl. Suka Jalan', 'level' => '5']
        ];
        
        foreach ($arrayPelanggan as $data) {
            Pelanggan::create($data);
        }
    }
}

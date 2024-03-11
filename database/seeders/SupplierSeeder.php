<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // List Supplier
        $arraySuplier = [
            ['id' => 1, 'nama' => 'CMYK Mart Surabaya','telp' => '0120131', 'alamat' => 'Jl. Apa Aja', 'deskripsi' => 'Pemasok bahan mesin besar'],
            ['id' => 2, 'nama' => 'CMYK Mart Jakarta','telp' => '12131209', 'alamat' => 'Jl. Mana', 'deskripsi' => 'Pemasok bahan cutting']
        ];

        // membuat list supplier sebanyak list diatas
        Supplier::insert($arraySuplier);
    }
}

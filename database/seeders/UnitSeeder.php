<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // List Satuan
        $arraySatuan = [
            ['id' => 1, 'nama' => 'cm'],
            ['id' => 2, 'nama' => 'm'],
        ];

        // membuat list supplier sebanyak list diatas
        Unit::insert($arraySatuan);
    }
}

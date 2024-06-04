<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Harga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $harga = Harga::create([
            'hpp' => '10000',
            'umum' => '30000',
            'reseller1' => '2000',
            'reseller2' => '15000',
        ]);

        $harga2 = Harga::create([
            'hpp' => '5000',
            'umum' => '10000',
            'reseller1' => '7000',
            'reseller2' => '6000',
        ]);

        Barang::create([
            'nama' => 'Art Paper',
            'jenis' => '1',
            'id_kategori'=> '1',
            'id_satuan' => '3',
            'stok' => '9',
            'id_harga' => $harga->id
        ]);

        Barang::create([
            'nama' => 'Fly Over',
            'jenis' => '2',
            'id_kategori'=> '1',
            'id_satuan' => '1',
            'stok' => '10',
            'id_harga' => $harga2->id
        ]);
    }
}

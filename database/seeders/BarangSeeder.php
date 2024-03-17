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
            'umum' => '50000',
            'reseller1' => '10000',
            'reseller2' => '20000',
            'reseller3' => '30000',
            'reseller4' => '40000',
        ]);

        Barang::create([
            'nama' => 'Fly Over',
            'jenis' => '1',
            'id_kategori'=> '1',
            'id_satuan' => '1',
            'stok' => '9',
            'id_harga' => $harga->id
        ]);
    }
}

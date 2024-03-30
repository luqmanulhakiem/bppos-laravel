<?php

namespace Database\Seeders;

use App\Models\BarangInOut;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangInOutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayData = [
            [
                'tanggal' => Carbon::now(),
                'id_barang' => '1',
                'id_penyuplai' => '1',
                'id_user' => '1',
                'ukuran' => 'Pcs/Unit',
                'kuantiti' => '9',
                'status' => 'masuk',
            ],
            [
                'tanggal' => Carbon::now(),
                'id_barang' => '1',
                'id_penyuplai' => '1',
                'id_user' => '1',
                'ukuran' => 'Pcs/Unit',
                'kuantiti' => '2',
                'status' => 'keluar',
            ]
        ];

        BarangInOut::insert($arrayData);

        BarangInOut::create([
            'tanggal' => Carbon::now(),
            'id_barang' => '1',
            'id_penyuplai' => '1',
            'id_user' => '1',
            'ukuran' => 'Pcs/Unit',
            'kuantiti' => '10',
            'status' => 'masuk',
        ]);
    }
}

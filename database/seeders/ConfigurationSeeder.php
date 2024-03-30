<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuration::create([
            'nama_lengkap' => 'Bintang Printama',
            'nama_singkat' => 'BP',
            'kabupaten' => 'Pamekasan',
            'telp' => '08112223333',
            'whatsapp' => '082233334444',
            'email' => 'bintangprint@gmail.com',
            'rekening_nama' => 'BRI',
            'rekening_nomer' => '11223344556677',
            'rekening_an' => 'Bintang Printama',
            'logo' => 'logo.jpeg',
            'logo_nota' => 'logo_nota.png',
            'member_card' => 'member_card.png',
        ]);

    }
}

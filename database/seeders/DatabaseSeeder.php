<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil Seeder untuk membuat data dummy
        $this->call([
            UserSeeder::class,
            SupplierSeeder::class,
            PelangganSeeder::class,
            KategoriSeeder::class,
            UnitSeeder::class,
            BarangSeeder::class,
            BarangInOutSeeder::class,
            ConfigurationSeeder::class,
        ]);
    }
}

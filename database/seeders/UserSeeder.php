<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hashing Password
        $password = Hash::make('password');
        
        // Tanggal saat ini
        $tanggal = Carbon::now();
        
        // List User
        $arrayUser = [
            ['id' => 1, 'username' => 'admin', 'user_foto' => 'CDN-IMG-FOTO-1.webp' , 'password' => $password, 'name' => 'Bintang Printama', 'level' => 'isAdmin', 'created_at' => $tanggal, 'updated_at' => $tanggal],
            ['id' => 2, 'username' => 'kasir', 'user_foto' => null, 'password' => $password, 'name' => 'kasir', 'level' => 'isKasir', 'created_at' => $tanggal, 'updated_at' => $tanggal],
            ['id' => 3, 'username' => 'design','user_foto' => null, 'password' => $password, 'name' => 'design', 'level' => 'isDesign', 'created_at' => $tanggal, 'updated_at' => $tanggal]
        ];

        // Membuat akun user sebanyak list user diatas
        User::insert($arrayUser);
    }
}

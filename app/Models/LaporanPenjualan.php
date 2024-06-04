<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'keterangan',
        'no_nota',
        'masuk',
        'keluar',
        'id_admin',
    ];
}

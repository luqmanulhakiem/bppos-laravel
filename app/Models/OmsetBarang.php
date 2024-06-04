<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OmsetBarang extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'ukuran_l',
        'ukuran_p',
        'kuantiti',
        'hpp',
        'harga_jual',
        'profit',
    ];
}

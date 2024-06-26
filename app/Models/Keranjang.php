<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pelanggan',
        'id_barang',
        'ukuran',
        'ukuran_p',
        'ukuran_l',
        'harga',
        'kuantitas',
        'diskon',
        'total'
    ];
}

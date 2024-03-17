<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangInOut extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal', 'id_barang', 'id_penyuplai', 'id_user', 'kuantiti', 'keterangan'];
    
}

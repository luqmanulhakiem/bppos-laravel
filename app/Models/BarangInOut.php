<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BarangInOut extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal', 'id_barang', 'id_penyuplai', 'id_user', 'kuantiti', 'keterangan'];

    public function barang(): HasOne
    {
        return $this->hasOne(Barang::class,'id', 'id_barang', 'id');
    }

    public function penyuplai(): HasOne
    {
        return $this->hasOne(Supplier::class,'id', 'id_penyuplai', 'id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class,'id', 'id_user', 'id');
    }
    
}

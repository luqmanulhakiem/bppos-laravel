<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_nota',  
        'id_pelanggan',  
        'id_kasir',  
        'tgl_penjualan',  
        'sub_total',  
        'diskon',  
        'grand_total',  
        'tgl_pengambilan',  
        'bayar',  
        'sisa',  
        'status_bayar',  
        'status',  
        'catatan', 
        'snap_token', 
    ];

    public function items(): HasMany
    {
        return $this->hasMany(PenjualanItem::class, 'id_penjualan', 'id');
    }
    public function pelanggan(): HasOne
    {
        return $this->hasOne(Pelanggan::class,'id', 'id_pelanggan', 'id');
    }
}

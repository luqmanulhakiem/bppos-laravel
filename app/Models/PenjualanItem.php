<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenjualanItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_penjualan',
        'id_barang',
        'ukuran',
        'ukurran_p',
        'ukurran_l',
        'harga',
        'kuantitas',
        'diskon',
        'total',
    ];

    public function penjualan(): BelongsTo
    {
        return $this->belongsTo(Penjualan::class);
    }

}
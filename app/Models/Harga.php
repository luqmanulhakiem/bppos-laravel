<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Harga extends Model
{
    use HasFactory;
    protected $fillable = ['hpp', 'umum', 'reseller1', 'reseller2'];
    
    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'id', 'id_harga');
    }
}

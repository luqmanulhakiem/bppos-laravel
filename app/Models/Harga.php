<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;
    protected $fillable = ['umum', 'reseller1', 'reseller2', 'reseller3', 'reseller4'];
    
}

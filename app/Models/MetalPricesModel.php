<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetalPricesModel extends Model
{
    use HasFactory;
    protected $table = 'metal_prices';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'metal_id',
        'price',
        'datetime',
        'userid',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by',
    ];
}

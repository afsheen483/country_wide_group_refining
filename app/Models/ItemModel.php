<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
    use HasFactory;
    protected $table = 'items';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'item_code',
        'item_name',
        'item_numbers',
        'item_make',
        'item_model',
        'item_year',
        'item_note',
        'item_image',
        'platinum_percentage',
        'pladium_percentage',
        'rhodium_percentage',
        'price',
        'created_by',
        'created_at',
        'modified_at',
        'modified_by',
        'is_deleted',
    ];
}

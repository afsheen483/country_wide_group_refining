<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserItemModel extends Model
{
    use HasFactory;
    protected $table = 'user_items';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'item_id',
        'user_id',
        'user_items_price',
        'date',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by',
        'is_deleted',
    ];
}

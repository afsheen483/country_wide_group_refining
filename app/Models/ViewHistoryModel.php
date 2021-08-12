<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewHistoryModel extends Model
{
    use HasFactory;
    protected $table = 'view_history';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'item_id',
        'user_id',
        'date',
        'created_at',
    ];
}

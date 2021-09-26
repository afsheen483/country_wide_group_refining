<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageModel extends Model
{
    use HasFactory;
    protected $table = 'images';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'item_id',
        'image_url',
        'date',
    ];
}

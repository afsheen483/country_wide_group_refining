<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetailModel extends Model
{
    use HasFactory;
    protected $table = 'invoice_details';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'invoice_head_id',
        'item_id',
        'quantity',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by',
        'is_deleted',
    ];
}

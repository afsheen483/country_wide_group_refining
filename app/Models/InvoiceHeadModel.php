<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceHeadModel extends Model
{
    use HasFactory;
    protected $table = 'invoice_head';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'vendor_id',
        'invoice_file',
        'vendor_signature',
        'invoice_date',
        'is_completed',
        'created_by',
        'created_at',
        'modified_at',
        'modified_by',
        'is_deleted',
    ];
}

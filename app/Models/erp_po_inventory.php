<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_po_inventory extends Model
{
    protected $fillable = [
        'product_id',
        'po_id','quantity','unit_price','taxes','discount','total_price','job','product_description',
        'created_at',
        'updated_at'
    ];
}
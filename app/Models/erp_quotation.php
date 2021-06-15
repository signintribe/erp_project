<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_quotation extends Model
{
    protected $fillable = [
        'user_id',
        'vendor_name',
        'item_name',
        'quantity',
        'unit_price',
        'total_price',
        'taxes',
        'discount',
        'address',
        'shipment_status',  
        'created_at',
        'updated_at'
    ];
}

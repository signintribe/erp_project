<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_purchase_order extends Model
{
    protected $fillable = [
        'mobile_number',
        'user_id',
        'po_date',
        'goods_date',
        'po_status',
        'shipment_status',
        'vendor_balance',
        'total_po',
        'product_item',
        'quantity',
        'unit_price',
        'taxes',
        'discount',
        'total_price',
        'job',
        'payment_mode',
        'chartofaccount_purchase',
        'chartofaccount_payment',
        'address',
        'description',    
        'created_at',
        'updated_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_purchase_order extends Model
{
    protected $fillable = [
        'vendor_id','user_id','po_date','goods_date','po_status','shipment_status','total_po','ship_via','chartofaccount_purchase','chartofaccount_payment',
        'created_at',
        'updated_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblproduct_stockavailability extends Model
{
    protected $fillable = [
        'product_id','stock_in_hand','store_name','reorder_quantity','stock_pur_order','stock_sale_order',
        'created_at',
        'updated_at'
    ];
}

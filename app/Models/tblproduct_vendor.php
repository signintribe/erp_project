<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblproduct_vendor extends Model
{
    protected $fillable = [
        'product_id','vendor_name','stock_class','product_status',
        'created_at',
        'updated_at'
    ];
}

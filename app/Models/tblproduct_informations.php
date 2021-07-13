<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblproduct_informations extends Model
{
    protected $fillable = [
        'user_id','barcode_id','product_name','product_description','category_id',
        'created_at',
        'updated_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblproduct_attributes extends Model
{
    protected $fillable = [
        'product_id','attribute_name',
        'created_at',
        'updated_at'
    ];
}

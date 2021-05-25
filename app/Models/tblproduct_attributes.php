<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblproduct_attributes extends Model
{
    protected $fillable = [
        'product_id',
        'value_id',
        'created_at',
        'updated_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_attribute extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'attribute_name',
        'created_at',
        'updated_at'
    ];
}

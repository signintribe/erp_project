<?php

namespace App\Models\CustomerModels;

use Illuminate\Database\Eloquent\Model;

class erp_customer_detail extends Model
{
    protected $fillable = [
        'customer_id',
        'contact_id',
        'social_id',
        'created_at',
        'updated_at'
    ];
}

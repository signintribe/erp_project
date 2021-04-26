<?php

namespace App\Models\CustomerModels;

use Illuminate\Database\Eloquent\Model;

class erp_customer_address extends Model
{
    protected $fillable = 
    [
        'customer_id', 
        'user_id',
        'address_id',
        'created_at', 
        'updated_at'
    ];
    
}

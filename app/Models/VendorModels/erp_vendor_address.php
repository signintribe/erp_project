<?php

namespace App\Models\VendorModels;

use Illuminate\Database\Eloquent\Model;

class erp_vendor_address extends Model
{
    protected $fillable = [
        'vendor_id', 
        'user_id',
        'address_id',
        'created_at', 
        'updated_at'
    ];
}

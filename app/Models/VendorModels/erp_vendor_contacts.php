<?php

namespace App\Models\VendorModels;

use Illuminate\Database\Eloquent\Model;

class erp_vendor_contacts extends Model
{
    protected $fillable = [
        'vendor_id',
        'contact_id',
        'social_id',
        'created_at',
        'updated_at'
    ];
}

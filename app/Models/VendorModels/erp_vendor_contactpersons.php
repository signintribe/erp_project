<?php

namespace App\Models\VendorModels;

use Illuminate\Database\Eloquent\Model;

class erp_vendor_contactpersons extends Model
{
    protected $fillable = [
        'vendor_id',
        'contact_id',
        'social_id',
        'address_id',
        'title',
        'first_name',
        'last_name',
        'picture',
        'created_at',
        'updated_at'
    ];
}

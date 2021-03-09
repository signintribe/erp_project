<?php

namespace App\Models\VendorModels;

use Illuminate\Database\Eloquent\Model;

class tblcompanydetail extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'company_name', 
        'office_timing', 
        'established', 
        'desription', 
        'company_logo',
        'address_id',
        'social_id',
        'contact_id', 
        'created_at', 
        'updated_at'
    ];
}

<?php

namespace App\Models\VendorModels;

use Illuminate\Database\Eloquent\Model;

class tblcompany_bankdetail extends Model
{
    protected $fillable = [
        'com_id',
        'bank_name',
        'address_id',
        'contact_id',
        'social_id',
        'created_at', 
        'updated_at'
    ];
}

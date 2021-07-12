<?php

namespace App\Models\VendorModels;

use Illuminate\Database\Eloquent\Model;

class tblcompany_address extends Model
{
    protected $fillable = [
        'com_id',
        'address_id',
        'created_at', 
        'updated_at'
    ];
}

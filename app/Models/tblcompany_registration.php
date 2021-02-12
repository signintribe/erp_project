<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblcompany_registration extends Model
{
    protected $fillable = [
        'company_id',
        'registration_id',
        'registration_name',
        'registration_authority',
        'registration_date',
        'expiry_date',
        'registration_authority_address',
        'website',
        'email',
        'phone_number',
        'mobile_number',
        'created_at',
        'updated_at'
    ];
}

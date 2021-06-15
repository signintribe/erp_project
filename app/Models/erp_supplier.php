<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_supplier extends Model
{
    protected $fillable = [
        'user_id',
        'vendor_type',
        'company_name',
        'company_address',
        'telephone_no',
        'mobile_no',
        'fax_no',
        'email',
        'whatsapp',
        'website',
        'contact_person',
        'passport',
        'currency',
        'status',  
        'created_at',
        'updated_at'
    ];
}

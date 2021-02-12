<?php

namespace App\Models\VendorModels;

use Illuminate\Database\Eloquent\Model;

class tblcompanydetail extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'company_name', 'phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'office_timing', 'established', 'address', 'desription', 'company_logo', 'created_at', 'updated_at'];
}

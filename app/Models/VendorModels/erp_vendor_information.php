<?php

namespace App\Models\VendorModels;

use Illuminate\Database\Eloquent\Model;

class erp_vendor_information extends Model
{
    protected $fillable = [
        'organization_name',
        'user_id',
        'ntn_no',
        'incroporation_no',
        'organization_logo',
        'strn',
        'import_license',
        'export_license',
        'chamber_no',
        'currency_dealing',
        'created_at',
        'updated_at'
    ];
}

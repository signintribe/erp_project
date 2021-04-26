<?php

namespace App\Models\CustomerModels;

use Illuminate\Database\Eloquent\Model;

class erp_customer_information extends Model
{
    protected $fillable = [
        'customer_type',
        'user_id',
        'customer_name',
        'ntn_no',
        'incroporation_no',
        'customer_logo',
        'strn',
        'import_license',
        'export_license',
        'chamber_no',
        'currency_dealing',
        'created_at',
        'updated_at'
    ];
}

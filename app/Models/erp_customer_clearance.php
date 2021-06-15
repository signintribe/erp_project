<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_customer_clearance extends Model
{
    protected $fillable = [
        'user_id','address_id','contact_id','social_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing',
        'created_at',
        'Updated_at',
    ];
}

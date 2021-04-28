<?php

namespace App\Models\CustomerModels;

use Illuminate\Database\Eloquent\Model;

class erp_customer_contactpersons extends Model
{
    protected $fillable = [
        'customer_id',
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

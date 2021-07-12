<?php

namespace App\Models\VendorModels;

use Illuminate\Database\Eloquent\Model;

class tbladdress extends Model
{
     /**
     * @var array
     */
    protected $fillable = ['address_line_1', 'foreign_key', 'address_line_2', 'address_line_3', 'street', 'sector', 'country', 'state', 'city','postal_code', 'zip_code', 'created_at', 'updated_at'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbladdress extends Model
{
    protected $fillable = [
        'address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code',
        'created_at',
        'updated_at'
    ];
}

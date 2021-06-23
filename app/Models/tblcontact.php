<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblcontact extends Model
{
    protected $fillable = [
        'phone_number','mobile_number','fax_number','whatsapp','email',
        'created_at',
        'updated_at	',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblcompany_calender extends Model
{
    protected $guarded = [];
     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'created_at',
    ];
}

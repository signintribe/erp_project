<?php

namespace App\Models\GlobalModel;

use Illuminate\Database\Eloquent\Model;

class ErpUserMenu extends Model
{
    protected $guarded = [];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}

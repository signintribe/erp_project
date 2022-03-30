<?php

namespace App\Models\CreationTire;

use Illuminate\Database\Eloquent\Model;

class ErpMenuRelation extends Model
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
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblsocialmedias extends Model
{
    protected $fillable = [
        'website',
        'twitter',
        'instagram',
        'facebook',
        'linkedin',
        'pinterest',
        'created_at',
        'updated_at'
    ];
}

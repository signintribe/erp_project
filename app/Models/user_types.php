<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_types extends Model
{ /**
     * @var array
     */
    protected $fillable = ['type_name', 'active'];

    public $timestamps = false;
    
}

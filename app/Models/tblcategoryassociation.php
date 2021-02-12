<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblcategoryassociation extends Model
{
     /**
     * @var array
     */
    protected $fillable = ['child_id', 'parent_id', 'created_at', 'updated_at'];
}

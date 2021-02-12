<?php

namespace App\Models\VendorModels;

use Illuminate\Database\Eloquent\Model;

class tblfollowup extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['query_id', 'follow_up', 'created_at', 'updated_at'];
}

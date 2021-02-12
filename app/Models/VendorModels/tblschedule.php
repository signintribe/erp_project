<?php

namespace App\Models\VendorModels;

use Illuminate\Database\Eloquent\Model;

class tblschedule extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['query_id', 'schedule_date', 'created_at', 'updated_at'];
}

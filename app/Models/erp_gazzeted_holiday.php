<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_gazzeted_holiday extends Model
{
    protected $fillable = [
        'department_id',
        'holiday_name',
        'holiday_event',
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblcompany_calender extends Model
{
    protected $fillable = [
        'department_id',
        'calender_name',
        'calender_type',
        'fiscal_financial',
        'calender_year',
        'calender_start_date',
        'calender_end_date',
        'total_month',
        'total_weeks',
        'total_days',
        'daysin_week',
        'daysin_hours',
        'daysin_month',
        'created_at',
        'updated_at'
    ];
}

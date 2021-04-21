<?php

namespace App\Models\employeeCenter;

use Illuminate\Database\Eloquent\Model;

class erp_employee_job_description extends Model
{
    protected $fillable = [
        'employee_id',
        'user_id',
        'daily_task',
        'weekly_task',
        'monthly_task',
        'created_at',
        'updated_at'
    ];
}

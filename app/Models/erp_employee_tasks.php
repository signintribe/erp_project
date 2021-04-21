<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_employee_tasks extends Model
{
    protected $fillable = [
        'employee_id',
        'user_id',
        'task_name',
        'task_date',
        'expected_date',
        'completion_status',
        'attachment',
        'completion_date',
        'delay_task',
        'efficiency',
        'negligency',
        'save_days',
    ];
}

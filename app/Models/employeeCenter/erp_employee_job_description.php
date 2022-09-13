<?php

namespace App\Models\employeeCenter;

use Illuminate\Database\Eloquent\Model;

class erp_employee_job_description extends Model
{
    protected $fillable = [
        'id',
        'task_id',
        'description',
        'pay_allowance',
        'created_at',
        'updated_at'
    ];
}

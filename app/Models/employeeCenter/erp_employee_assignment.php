<?php

namespace App\Models\employeeCenter;

use Illuminate\Database\Eloquent\Model;

class erp_employee_assignment extends Model
{
    protected $fillable = [
        'employee_id',
        'user_id',
        'master_company',
        'child_company',
        'department',
        'supervisor_name',
        'supervisor_designation',
        'appointment_date',
        'promotion_date',
        'designation',
        'pay_scale',
        'working_since',
        'created_at',
        'updated_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_tasks_assigned_details extends Model
{
    protected $fillable = [
        'task_id',
        'master_company',
        'child_company',
        'department_name',
        'supervisor',
        'supervisor_designation'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_employee_jd extends Model
{
    protected $fillable = [
        'id',
        'task_name',
        'task_sop',
        'dose_repeat',
        'attachment',
        'frequency_repeat',
        'created_at',
        'updated_at'
    ];
}

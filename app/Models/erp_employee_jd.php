<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_employee_jd extends Model
{
    protected $fillable = [
        'department_id',
        'jd_name',
        'description',
        'attachment',
        'created_at',
        'updated_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_employee_group extends Model
{
    protected $fillable = [
        'department_id',
        'group_name',
        'group_category',
        'scope_group',
        'created_at',
        'updated_at'
    ];
}

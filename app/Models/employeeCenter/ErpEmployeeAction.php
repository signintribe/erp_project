<?php

namespace App\Models\employeeCenter;

use Illuminate\Database\Eloquent\Model;

class ErpEmployeeAction extends Model
{
    protected $fillable = [
        'action',
        'employee_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}

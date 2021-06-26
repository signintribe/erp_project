<?php

namespace App\Models\employeeCenter;

use Illuminate\Database\Eloquent\Model;

class erp_employee_education extends Model
{
    protected $fillable = [
        'employee_id',
        'user_id',
        'qualification_name',
        'passing_year',
        'subject',
        'institute',
        'total_marks',
        'obtain_marks',
        'grade',
        'division',
        'distinction',
        'created_at',
        'updated_at'
    ];
}

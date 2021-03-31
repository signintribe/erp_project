<?php

namespace App\Models\employeeCenter;

use Illuminate\Database\Eloquent\Model;

class erp_employee_certification extends Model
{
    protected $fillable = [
        'employee_id',
        'user_id',
        'certification_name',
        'start_date',
        'end_date',
        'training_type',
        'training_institute',
        'training_venue',
        'training_referred_by',
        'subjects',
        'training_purpose',
        'created_at',
        'updated_at'
    ];
}

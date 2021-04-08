<?php

namespace App\Models\employeeCenter;

use Illuminate\Database\Eloquent\Model;

class erp_pay_emoluments extends Model
{
    protected $fillable = [
        'employee_id',
        'basic_pay',
        'user_id',
        'medical_allowance',
        'conveyance_allowance',
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

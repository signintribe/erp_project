<?php

namespace App\Models\employeeCenter;

use Illuminate\Database\Eloquent\Model;

class erp_spouse_detail extends Model
{
    protected $fillable = [
        'employee_id',
        'address_id',
        'contact_id',
        'spouse_first_name',
        'spouse_middle_name',
        'spouse_last_name',
        'relation',
        'gender',
        'dob',
        'domicile',
        'marital_status',
        'patronage',
        'created_at',
        'updated_at'
    ];
}

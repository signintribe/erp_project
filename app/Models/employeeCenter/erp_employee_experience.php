<?php

namespace App\Models\employeeCenter;

use Illuminate\Database\Eloquent\Model;

class erp_employee_experience extends Model
{
    protected $fillable = [
        'user_id',
        'employee_id',
        'designation',
        'organization',
        'reference_number',
        'worked_to',
        'worked_from',
        'total_period',
        'remarks_employee',
        'contact_id',
        'address_id',
        'created_at',
        'updated_at'
    ];
}

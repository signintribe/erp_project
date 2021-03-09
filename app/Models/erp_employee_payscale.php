<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_employee_payscale extends Model
{
    protected $fillable = [
        'department_id',
        'payscale_name',
        'initial_pay',
        'annual_increments',
        'endingpay_payscale',
        'complete_payscale',
        'number_stage',
        'implementation_year',
        'status',
        'valid_till',
        'created_at',
        'updated_at'
    ];
}

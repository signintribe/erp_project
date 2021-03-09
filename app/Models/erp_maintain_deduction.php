<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_maintain_deduction extends Model
{
    protected $fillable = [
        'department_id',
        'calendar_id',
        'shift_id',
        'allowance',
        'per_amount',
        'amount',
        'pay_frequency',
        'hourly',
        'rate',
        'deduction_rule',
        'account_id',
        'created_at',
        'updated_at'
    ];
}

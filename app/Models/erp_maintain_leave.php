<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_maintain_leave extends Model
{
    protected $fillable = [
        'department_id',
        'leave_type',
        'total_leave',
        'leave_rules',
        'leave_deduction',
        'leave_rate',
        'lapsed',
        'created_at',
        'updated_at'
    ];
}

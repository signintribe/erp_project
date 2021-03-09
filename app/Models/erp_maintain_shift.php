<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_maintain_shift extends Model
{
    protected $fillable = [
        'department_id',
        'shift_name',
        'description',
        'shift_start_time',
        'shift_end_time',
        'mealbreak_start_time',
        'mealbreak_end_time',
        'teabreak_start_time',
        'teabreak_end_time',
        'total_workinhours',
        'created_at',
        'updated_at'
    ];
}

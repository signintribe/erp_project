<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_employee_jd extends Model
{
    protected $fillable = [
        'id',
        'jd_name',
        'company_id',
        'user_id',
        'jd_sop',
        'dose_repeat',
        'attachment',
        'frequency_repeat',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}

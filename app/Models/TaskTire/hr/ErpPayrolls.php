<?php

namespace App\Models\TaskTire\hr;

use Illuminate\Database\Eloquent\Model;
use App\Models\tblmaintain_office;
use App\Models\tbldepartmen;
use App\Models\erp_employee_group;
class ErpPayrolls extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function office()
    {
        return $this->belongsTo(tblmaintain_office::class);
    }
    
    public function department()
    {
        return $this->belongsTo(tbldepartmen::class);
    }

    public function group()
    {
        return $this->belongsTo(erp_employee_group::class);
    }

    public function allowances()
    {
        return $this->hasMany(PayrollAllowance::class);
    }

    public function deductions()
    {
        return $this->hasMany(PayrollDeduction::class);
    }

    public function libilities()
    {
        return $this->hasMany(PayrollLibility::class);
    }
}

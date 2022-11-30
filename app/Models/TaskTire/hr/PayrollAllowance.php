<?php

namespace App\Models\TaskTire\hr;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskTire\hr\ErpPayrolls;
use App\Models\CreationTire\HumanResources\ErpAllowance;
class PayrollAllowance extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function allowances()
    {
        return $this->belongsTo(ErpPayrolls::class);
    }

    public function payrollallowance()
    {
        return $this->belongsTo(ErpAllowance::class);
    }
}

<?php

namespace App\Models\CreationTire\HumanResources;

use Illuminate\Database\Eloquent\Model;

class ErpPayAllowance extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public function allowances()
    {
        return $this->hasMany(ErpAllowance::class);
    }
    
    public function pays()
    {
        return $this->hasMany(ErpPay::class);
    }

    public function libilities()
    {
        return $this->hasMany(ErpLibility::class);
    }

    public function deductions()
    {
        return $this->hasMany(ErpDeduction::class);
    }
}

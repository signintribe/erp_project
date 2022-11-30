<?php

namespace App\Models\CreationTire\HumanResources;

use Illuminate\Database\Eloquent\Model;
//use App\Models\TaskTire\hr\PayrollPay;
class ErpPay extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated'];

    public function pay_allowance()
    {
        return $this->belongsTo(ErpPayAllowance::class);
    }

    public function pays()
    {
        return $this->hasMany(PayrollPay::class);
    }
}

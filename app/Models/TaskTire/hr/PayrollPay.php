<?php

namespace App\Models\TaskTire\hr;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskTire\hr\ErpPayrolls;
use App\Models\CreationTire\HumanResources\ErpPay;
class PayrollPay extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function pays()
    {
        return $this->belongsTo(ErpPay::class);
    }

    /* public function pays()
    {
        return $this->belongsTo(ErpPay::class);
    } */
}

<?php

namespace App\Models\CreationTire\HumanResources;

use Illuminate\Database\Eloquent\Model;

class ErpLibility extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated'];
    
    public function pay_allowance()
    {
        return $this->belongsTo(ErpPayAllowance::class);
    }
}

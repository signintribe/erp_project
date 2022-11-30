<?php

namespace App\Models\TaskTire\hr;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskTire\hr\ErpPayrolls;
class PayrollLibility extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function libilities()
    {
        return $this->belongsTo(ErpPayrolls::class);
    }
}

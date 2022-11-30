<?php

namespace App\Models\TaskTire\hr;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskTire\hr\ErpPayrolls;
class PayrollDeduction extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function deductions()
    {
        return $this->belongsTo(ErpPayrolls::class);
    }
}

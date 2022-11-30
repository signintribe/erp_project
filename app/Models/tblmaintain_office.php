<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblmaintain_office extends Model
{
    protected $fillable = [
        'company_id',
        'office_name',
        'office_type',
        'start_date',
        'office_status',
        'scope_office',
        'address_id',
        'contact_id',
        'social_id',
        'created_at',
        'updated_at'
    ];

    public function payroll()
    {
        return $this->hasOne(ErpPayrolls::class);
    }
}

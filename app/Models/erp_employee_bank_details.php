<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class erp_employee_bank_details extends Model
{
    protected $fillable = [
        'user_id',
        'employee_id',
        'account_title',
        'bank_name',
        'branch_name',
        'branch_code',
        'iban_no',
        'bank_key',
        'account_type',
        'contact_id',
        'social_id',
        'address_id',
        'created_at',
        'updated_at'
    ];
}

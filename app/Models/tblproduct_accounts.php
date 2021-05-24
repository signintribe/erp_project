<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblproduct_accounts extends Model
{
    protected $fillable = [
        'product_id','chartof_account_cost','chartof_account_inventory','chartof_account_sale',
        'created_at',
        'updated_at'
    ];
}

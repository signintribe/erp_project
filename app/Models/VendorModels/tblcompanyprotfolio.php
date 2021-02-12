<?php

namespace App\Models\VendorModels;

use Illuminate\Database\Eloquent\Model;

class tblcompanyprotfolio extends Model
{
     /**
     * @var array
     */
    protected $fillable = ['company_id', 'portfolio_image', 'created_at', 'updated_at'];
}

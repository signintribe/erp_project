<?php

namespace App\Models\VendorModels;

use Illuminate\Database\Eloquent\Model;

class tblcompanysocial extends Model
{
     /**
     * @var array
     */
    protected $fillable = ['facebook', 'linkedin', 'youtube', 'twitter', 'website', 'company_id', 'created_at', 'updated_at'];
}

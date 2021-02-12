<?php

namespace App\Models\VendorModels;

use Illuminate\Database\Eloquent\Model;

class tblcustomerquery extends Model
{
   /**
     * @var array
     */
    protected $fillable = ['category_id', 'company_id', 'customer_id', 'query_description', 'status', 'expected_date', 'installing_date', 'schedule_date', 'lat', 'lang', 'price', 'reject_comment', 'created_at', 'updated_at'];
}

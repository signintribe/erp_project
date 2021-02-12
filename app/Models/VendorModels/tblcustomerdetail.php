<?php

namespace App\Models\VendorModels;

use Illuminate\Database\Eloquent\Model;

class tblcustomerdetail extends Model {

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'full_name', 'created_at', 'updated_at'];

}

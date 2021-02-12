<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\VendorModels;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of tblselectedvendorcategory
 *
 * @author Attique
 */
class tblselectedvendorcategory extends Model {

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'company_id', 'created_at', 'updated_at'];

}

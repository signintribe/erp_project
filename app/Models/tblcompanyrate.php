<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of tblcompanyrate
 *
 * @author Attique
 */
class tblcompanyrate extends Model {

    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'rated_vlaue', 'rated_description', 'created_at', 'updated_at'];

}

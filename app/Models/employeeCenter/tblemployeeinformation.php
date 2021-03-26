<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tblemployeeinformation
 *
 * @author Attique
 */

namespace App\Models\employeeCenter;

use Illuminate\Database\Eloquent\Model;

class tblemployeeinformation  extends Model{

    /**
     * @var array
     */
    protected $fillable = [
        'employee_id', 
        'contact_id',
        'social_id',
        'user_id',
        'address_id',
        'first_name', 
        'middle_name', 
        'last_name', 
        'father_name', 
        'religion', 
        'sect', 
        'next_of_kin',
        'dob', 
        'nationality', 
        'marital_status',
        'domicile',
        'proficiency_languages', 
        'gender', 
        'cnic', 
        'created_at', 
        'updated_at'
    ];

}

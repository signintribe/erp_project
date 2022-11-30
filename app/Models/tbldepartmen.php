<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * Description of tbldepartmen
 *
 * @author Attique
 */
class tbldepartmen extends Model { /**
 * @var array
 */

    protected $fillable = [
        'office_id', 
        'department_name', 
        'description',
        'start_date',
        'department_scope',
        'department_status',
        'address_id',
        'contact_id',
        'social_id', 
        'created_by', 
        'updated_by'
    ];

    public function payroll()
    {
        return $this->hasOne(ErpPayrolls::class);
    }

}

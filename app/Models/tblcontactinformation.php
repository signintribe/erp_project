<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Description of tblcontactinformation
 *
 * @author Attique
 */
class tblcontactinformation extends Model{
     /**
     * @var array
     */
    protected $fillable = ['email', 'phone_number', 'mobile_number', 'fax_number', 'facebook', 'linkedin', 'whatsapp', 'twitter', 'instgram', 'website', 'created_at', 'updated_at'];
}

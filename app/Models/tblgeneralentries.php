<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblgeneralentries extends Model
{ /**
     * @var array
     */
    protected $fillable = ['account_Id','date','refrance','description', 'credit', 'debit', 'user_type_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

   
    
}

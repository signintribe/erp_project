<?php

namespace App\Models\TaskTire\WorkFlow;

use Illuminate\Database\Eloquent\Model;

class ErpWorkflowForward extends Model
{
    protected $guarded = [];
    
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}

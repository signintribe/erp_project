<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblcategory extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'category_name',
        'category_image', 
        'category_description',
        'product_category', 
        'created_at', 
        'updated_at'
    ];
}

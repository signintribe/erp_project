<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Tblmastercategory $tblmastercategory
 * @property Tblmastercategory $tblmastercategory
 * @property int $id
 * @property int $CategoryParentId
 * @property int $CategoryChildId
 * @property int $Flag
 * @property string $created_at
 * @property string $updated_at
 */
class tblaccountparentchildassociations extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['CategoryParentId', 'CategoryChildId'];
    public $timestamps = false;

  

}

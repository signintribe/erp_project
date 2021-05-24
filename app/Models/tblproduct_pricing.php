<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblproduct_pricing extends Model
{
    protected $fillable = [
        'product_id','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price',
        'created_at',
        'updated_at'
    ];
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\tblproduct_informations;
use App\Models\tblproduct_pricing;
use App\Models\tblproduct_attributes;
use App\Models\tblproduct_vendor;
use App\Models\tblproduct_stockavailability;
use App\Models\tblproduct_accounts;
use Auth;
use DB;
/**
 * Description of InventoryController
 *
 * @author Attique
 */
class InventoryController extends Controller{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
       return view('inventory_center.add_inventory');
    }
    
    public function view_inventory() {
       return view('inventory_center.view_inventory');
    }

    public function saveInventory(Request $request)
    {
        $product = $request->except('stock_sale_order','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','product_id','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price',);
        $attributes = $request->except('stock_sale_order','product_name','product_description','category_id','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price',);
        $pricing = $request->except('stock_sale_order','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale',);
        $vendor = $request->except('stock_sale_order','product_name','product_description','category_id','attribute_name','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price',);
        $stock = $request->except('product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','chartof_account_cost','chartof_account_inventory','chartof_account_sale','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price',);
        $account = $request->except('stock_sale_order','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price',);
        $product['user_id'] = Auth::user()->id;
        tblproduct_informations::create($product);
        $attributes['product_id'] = $product->id;
        tblproduct_attributes::create($attributes);
        $pricing['product_id'] = $product->id;
        tblproduct_pricing::create($pricing);
        $vendor['product_id'] = $product->id;
        tblproduct_vendor::create($vendor);
        $stock['product_id'] = $product->id;
        tblproduct_stockavailability::create($stock);
        $account['product_id'] = $product->id;
        tblproduct_accounts::create($account);
        

        return 'Successfully Add Har Cheez';
    }
}

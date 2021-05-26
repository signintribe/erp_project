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
        if($request->id){
            $product = $request->except('id','user_id','attributes','stock_sale_order','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','product_id','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price');
            $attributes = $request->except('id','stock_sale_order','product_name','product_description','category_id','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price');
            $pricing = $request->except('id','attributes','stock_sale_order','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale');
            $vendor = $request->except('id','attributes','stock_sale_order','product_name','product_description','category_id','attribute_name','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price');
            $stock = $request->except('id','attributes','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','chartof_account_cost','chartof_account_inventory','chartof_account_sale','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price',);
            $account = $request->except('id','attributes','stock_sale_order','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price');
            tblproduct_informations::where('id', $request->id)->update($product);
            tblproduct_attributes::where('product_id', $request->id)->update($attributes);
            tblproduct_vendor::where('product_id', $request->id)->update($vendor);
            tblproduct_stockavailability::where('product_id', $request->id)->update($stock);
            tblproduct_pricing::where('product_id', $request->id)->update($pricing );
            tblproduct_accounts::where('product_id', $request->id)->update($account);
        }else{
            $product = $request->except('attributes','stock_sale_order','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','product_id','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price');
            $attributes = $request->except('stock_sale_order','product_name','product_description','category_id','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price');
            $pricing = $request->except('attributes','stock_sale_order','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale');
            $vendor = $request->except('attributes','stock_sale_order','product_name','product_description','category_id','attribute_name','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price');
            $stock = $request->except('attributes','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','chartof_account_cost','chartof_account_inventory','chartof_account_sale','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price',);
            $account = $request->except('attributes','stock_sale_order','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price');
            $product['user_id'] = Auth::user()->id;

            $products = tblproduct_informations::create($product);
            $attributes['product_id'] = $products->id;
            $pricing['product_id'] = $products->id;
            tblproduct_pricing::create($pricing);
            $vendor['product_id'] = $products->id;
            tblproduct_vendor::create($vendor);
            $stock['product_id'] = $products->id;
            tblproduct_stockavailability::create($stock);
            $account['product_id'] = $products->id;
            tblproduct_accounts::create($account);

            $attribute = json_decode($attributes['attributes'], true);
            for ($i=0; $i < count($attribute); $i++) { 
                tblproduct_attributes::create([
                    'product_id' => $products->id,
                    'value_id' => $attribute[$i]
                ]);
            }
            return 'Successfully Add Har Cheez';
        }
    }

    public function getInventory(){
        return $Accounts = DB::select('call sp_getinventoryinfo(1)');
    }

    public function getStock($id){
        return tblproduct_stockavailability::where('product_id', $id)->first();
    }

    public function getPricing($id){
        return tblproduct_pricing::where('product_id', $id)->first();
    }

    public function getAccount($id){
        return tblproduct_accounts::where('product_id', $id)->first();
    }

    public function getVendor($id){
        return tblproduct_vendor::where('product_id', $id)->first();
    }

    public function editAddInventory($id) {
        return view('inventory_center.edit_inventory', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editInventory($id)
    {
        return tblproduct_informations::where('id', $id)->first();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteInventory($id)
    {
        $inventory = tblproduct_pricing::where('product_id', $id)->first();
        tblproduct_pricing::where('product_id', $inventory->product_id)->delete();
        tblproduct_attributes::where('product_id', $inventory->product_id)->delete();
        tblproduct_vendor::where('product_id', $inventory->product_id)->delete();
        tblproduct_stockavailability::where('product_id', $inventory->product_id)->delete();
        tblproduct_accounts::where('product_id', $inventory->product_id)->delete();
        $task = tblproduct_informations::where('id', $id)->first();
        tblproduct_informations::where('id', $id)->delete();
        return 'Inventory Info Delete Permanently';
    }
}

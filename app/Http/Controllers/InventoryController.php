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
use App\Models\tblcategoryassociation;
use App\Models\tblcategory;
use App\Models\erp_attribute;
use App\Models\erp_attribute_value;
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
       //return $request->all();

        if($request->id){
            $product = $request->except('id','user_id','attributes','stock_sale_order','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','product_id','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price');
            $attributes = $request->except('id','user_id','stock_sale_order','product_name','product_description','category_id','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price');
            $pricing = $request->except('id','user_id','attributes','stock_sale_order','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale');
            $vendor = $request->except('id','user_id','attributes','stock_sale_order','product_name','product_description','category_id','attribute_name','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price');
            $stock = $request->except('id','user_id','attributes','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','chartof_account_cost','chartof_account_inventory','chartof_account_sale','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price',);
            $account = $request->except('id','user_id','attributes','stock_sale_order','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price');
            tblproduct_informations::where('id', $request->id)->update($product);
            $data = json_decode($attributes['attributes'], true);
            if (!empty($data)){
                tblproduct_attributes::where('product_id', $request->id)->delete();
            }
            $attribute = json_decode($attributes['attributes'], true);
            for ($i=0; $i < count($attribute); $i++) { 
                tblproduct_attributes::create([
                    'product_id' => $request->id,
                    'value_id' => $attribute[$i]
                ]);
            }              
            tblproduct_vendor::where('product_id', $request->id)->update($vendor);
            tblproduct_stockavailability::where('product_id', $request->id)->update($stock);
            tblproduct_pricing::where('product_id', $request->id)->update($pricing );
            tblproduct_accounts::where('product_id', $request->id)->update($account);
            return 'Inventory Info Update Successfully';
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
            return 'Inventory Info Save Successfully';
        }
    }

    public function getInventory(){
        return $Accounts = DB::select('call sp_getinventoryinfo('.Auth::user()->id.')');
    }

    public function getStock($id){
        return tblproduct_stockavailability::select('product_id','stock_in_hand','store_name','reorder_quantity','stock_pur_order','stock_sale_order')->where('product_id', $id)->first();
        //return tblproduct_stockavailability::where('product_id', $id)->first();
    }

    public function getPricing($id){
        return tblproduct_pricing::select('product_id','income_tax','withholding_tax','sales_tax','fed','import_duty','tax_adjustment','tax_exemption','delivery_charges','gross_pur_price','carriage_inward_charges','octri_taxes','net_pur_price')->where('product_id', $id)->first();
    }

    public function getAccount($id){
        return tblproduct_accounts::select('product_id','chartof_account_cost','chartof_account_inventory','chartof_account_sale')->where('product_id', $id)->first();
    }

    public function getVendor($id){
        return tblproduct_vendor::select('product_id','vendor_name','stock_class','product_status')->where('product_id', $id)->first();
    }

    public function getCategory($id){
        $cat = tblcategory::where('id', $id)->first();
        $catname = $cat->category_name;
        $cats = array();
        $cats[] = $catname; 
        $getparent = tblcategoryassociation::where('child_id', $id)->first();
        $parent = $getparent->parent_id;
        while($parent){
            $cat = tblcategory::where('id', $parent)->first();
            $cats[] = $cat->category_name;
            $getparent = tblcategoryassociation::where('child_id', $cat->id)->first();
            if(!empty($getparent)){
                $parent = $getparent->parent_id;
            }else{
                break;
            }
        }
        return array_reverse($cats);
    }

    public function getAttribute($id){
        $attributes = array();
        $attr = erp_attribute::where('category_id', $id)->get();
        foreach ($attr as $key => $value) {
            $attrvalue = erp_attribute_value::where('attribute_id', $value['id'])->get();
            $attributes[] = array(
                $value['attribute_name'] => $attrvalue
            );
        }
        return response()->json(['status' => true, 'data' => $attributes]);

    }

    public function selectedAttribute($id){
        return tblproduct_attributes::where('product_id', $id)->get();
    }

    public function editAddInventory($id){
        return view('inventory_center.edit_inventory', compact('id'));
    }

    public function searchInventory($barcode){
        return DB::select('SELECT inventory.*, cat.category_name, ven.organization_name FROM (SELECT * FROM `tblproduct_informations` WHERE barcode_id LIKE "'.$barcode.'%" OR id = "'.$barcode.'" limit 10) AS inventory JOIN(SELECT id, category_name FROM tblcategories) AS cat ON cat.id = inventory.category_id JOIN(SELECT id, product_id, vendor_name FROM tblproduct_vendors) AS vendors ON vendors.product_id = inventory.id JOIN(SELECT id, organization_name FROM erp_vendor_informations) AS ven ON ven.id = vendors.vendor_name');
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

    public function getProductInfo($pro_id){
        return DB::select('call sp_getproductsinfo('.Auth::user()->id.','.$pro_id.')');
    }
}

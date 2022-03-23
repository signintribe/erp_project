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
use App\Models\InventoryModels\ErpProductTax;
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
            try{
                $product = $request->except('created_at', 'updated_at', 'id', 'user_id' ,'attributes','stock_sale_order','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','product_id','delivery_charges','cost_price','carriage_inward_charges','purchase_price', 'profit', 'profit_type', 'sale_price', 'taxes_included');
                $attributes = $request->except('created_at', 'updated_at', 'id', 'user_id' ,'barcode_id','stock_sale_order','product_name','product_description','category_id','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','delivery_charges','cost_price','carriage_inward_charges','purchase_price', 'profit', 'profit_type', 'sale_price', 'taxes_included');
                $pricing = $request->except('created_at', 'updated_at', 'id', 'user_id' ,'taxes_included', 'barcode_id','attributes','stock_sale_order','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale');
                $vendor = $request->except('created_at', 'updated_at', 'id', 'user_id' ,'barcode_id','attributes','stock_sale_order','product_name','product_description','category_id','attribute_name','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','delivery_charges','cost_price','carriage_inward_charges','purchase_price', 'profit', 'profit_type', 'sale_price', 'taxes_included');   
                
                if($request->vendor_name != 'NaN'){
                    if(count(tblproduct_vendor::where('product_id', $request->id)->get()) <= 0){  
                        $vendor['product_id'] = $request->id;
                        tblproduct_vendor::create($vendor);
                    }else{
                        tblproduct_vendor::where('product_id', $request->id)->update($vendor);
                    }
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Please Selectd Vendor First'
                    ]);
                }
                $stock = $request->except('created_at', 'updated_at', 'id', 'user_id' ,'barcode_id','attributes','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','chartof_account_cost','chartof_account_inventory','chartof_account_sale','delivery_charges','cost_price','carriage_inward_charges','purchase_price', 'profit', 'profit_type', 'sale_price', 'taxes_included');
                $account = $request->except('created_at', 'updated_at', 'id', 'user_id' ,'barcode_id','attributes','stock_sale_order','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','delivery_charges','cost_price','carriage_inward_charges','purchase_price', 'profit', 'profit_type', 'sale_price', 'taxes_included');
                $data = json_decode($attributes['attributes'], true);
                tblproduct_informations::where('id', $request->id)->update($product);
                if (!empty($data)){
                    tblproduct_attributes::where('product_id', $request->id)->delete();
                    $attribute = json_decode($attributes['attributes'], true);
                    for ($i=0; $i < count($attribute); $i++) { 
                        tblproduct_attributes::create([
                            'product_id' => $request->id,
                            'value_id' => $attribute[$i]
                        ]);
                    } 
                }        

                if(count(tblproduct_stockavailability::where('product_id', $request->id)->get()) > 0 ){
                    tblproduct_stockavailability::where('product_id', $request->id)->update($stock);
                }else{
                    $stock['product_id'] = $request->id;
                    tblproduct_stockavailability::create($stock);
                }
                if(count(tblproduct_pricing::where('product_id', $request->id)->get()) > 0){
                    tblproduct_pricing::where('product_id', $request->id)->update($pricing);
                }else{
                    $pricing['product_id'] = $request->id;
                    tblproduct_pricing::create($pricing);
                }

                if(count(tblproduct_accounts::where('product_id', $request->id)->get()) > 0){
                    tblproduct_accounts::where('product_id', $request->id)->update($account);
                }else{
                    $account['product_id'] = $request->id;
                    tblproduct_accounts::create($account);
                }

                $taxes = json_decode($request->taxes_included, true);
                if(count($taxes) > 0){
                    ErpProductTax::where('product_id', $request->id)->delete();
                    for ($i=0; $i < count($taxes); $i++) { 
                        ErpProductTax::create([
                            'product_id' => $request->id,
                            'tax_id' => $taxes[$i]
                        ]);
                    }
                }
                return response()->json(['status' => true, 'message' => 'Inventory Info Update Successfully']);
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json(['status' => false, 'message' => $e->errorInfo[2]]);
            }
        }else{
            $product = $request->except('attributes','stock_sale_order','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','product_id','delivery_charges','cost_price','carriage_inward_charges','purchase_price', 'profit', 'profit_type', 'sale_price', 'taxes_included');
            $attributes = $request->except('barcode_id','stock_sale_order','product_name','product_description','category_id','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','delivery_charges','cost_price','carriage_inward_charges','purchase_price', 'profit', 'profit_type', 'sale_price', 'taxes_included');
            $pricing = $request->except('taxes_included', 'barcode_id','attributes','stock_sale_order','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale');
            $vendor = $request->except('barcode_id','attributes','stock_sale_order','product_name','product_description','category_id','attribute_name','stock_in_hand','store_name','reorder_quantity','stock_pur_order','chartof_account_cost','chartof_account_inventory','chartof_account_sale','delivery_charges','cost_price','carriage_inward_charges','purchase_price', 'profit', 'profit_type', 'sale_price', 'taxes_included');
            $stock = $request->except('barcode_id','attributes','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','chartof_account_cost','chartof_account_inventory','chartof_account_sale','delivery_charges','cost_price','carriage_inward_charges','purchase_price', 'profit', 'profit_type', 'sale_price', 'taxes_included');
            $account = $request->except('barcode_id','attributes','stock_sale_order','product_name','product_description','category_id','attribute_name','vendor_name','stock_class','product_status','stock_in_hand','store_name','reorder_quantity','stock_pur_order','delivery_charges','cost_price','carriage_inward_charges','purchase_price', 'profit', 'profit_type', 'sale_price', 'taxes_included');
            $product['user_id'] = Auth::user()->id;

            $products = tblproduct_informations::create($product);
            $attributes['product_id'] = $products->id;
            $pricing['product_id'] = $products->id;
            //return $pricing;
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

            $taxes = json_decode($request->taxes_included, true);
            for ($i=0; $i < count($taxes); $i++) { 
                ErpProductTax::create([
                    'product_id' => $products->id,
                    'tax_id' => $taxes[$i]
                ]);
            }

            return 'Inventory Info Save Successfully';
        }
    }

    public function getInventory($offset, $limit){
        return $Accounts = tblproduct_informations::where('user_id', Auth::user()->id)->skip($offset)->take($limit)->get();
    }

    public function getStock($id){
        return tblproduct_stockavailability::select('product_id','stock_in_hand','store_name','reorder_quantity','stock_pur_order','stock_sale_order')->where('product_id', $id)->first();
        //return tblproduct_stockavailability::where('product_id', $id)->first();
    }

    public function getPricing($id){
        return tblproduct_pricing::select('product_id', 'delivery_charges', 'cost_price', 'carriage_inward_charges', 'purchase_price', 'sale_price', 'profit_type', 'profit')->where('product_id', $id)->first();
    }

    public function seletedTaxes($product_id)
    {
        $taxes = DB::select('SELECT st.product_id, st.tax_id, authority.authority_name, taxes.company_id, taxes.tax_nature, taxes.tax_percentage, taxes.tax_levid FROM (SELECT * FROM erp_product_taxes WHERE product_id = '.$product_id.')AS st JOIN(SELECT * FROM erp_company_taxes) AS taxes ON taxes.id = st.tax_id JOIN(SELECT id, authority_name FROM erp_authorities)AS authority ON authority.id = taxes.tax_authority');
        return response()->json([
            'status'=>true,
            'message'=>'All Seleted Taxes with product',
            'data' => $taxes
        ]);
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
        if($getparent){
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
        //return $barcode;
        return DB::select('SELECT inventory.*, cat.category_name, ven.organization_name FROM (SELECT * FROM `tblproduct_informations` WHERE barcode_id = "'.$barcode.'" OR product_name LIKE "%'.$barcode.'%" limit 10) AS inventory LEFT JOIN(SELECT id, category_name FROM tblcategories) AS cat ON cat.id = inventory.category_id LEFT JOIN(SELECT id, product_id, vendor_name FROM tblproduct_vendors) AS vendors ON vendors.product_id = inventory.id LEFT JOIN(SELECT id, organization_name FROM erp_vendor_informations) AS ven ON ven.id = vendors.vendor_name');
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

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\erp_purchase_order;
use App\Models\erp_po_inventory;
use Auth;
use DB;
/**
 * Description of PurchaseOrderController
 *
 * @author Attique
 */
class PurchaseOrderController extends Controller{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('purchase_order.add_purchaseorder');
    }
    
    public function add_purchase_receive(){
        return view('purchase_order.add_purchasereceive');
    }
    
    public function view_purchase_order(){
        return view('purchase_order.view_purchase_order');
    }
    
    public function view_purchase_receive(){
        return view('purchase_order.view_purchase_receive');
    }

    public function getpurchaseOrder(){
        return erp_purchase_order::all();
    }

    public function savePurchaseOrder(Request $request){
      //return $request->all();

      $data = json_decode($request->orderDetail,true);
      if($request->id){
            erp_po_inventory::where('po_id', $request->id)->delete();
             erp_purchase_order::where('id', $request->id)->update([
                'vendor_id' => $request->vendor_id,
                'po_date' => $request->po_date,
                'goods_date' => $request->goods_date,
                'po_status' => $request->po_status,
                'shipment_status' => $request->shipment_status,
                'total_po' => $request->total_po,
                'ship_via' => $request->ship_via,
                'chartofaccount_purchase' => $request->chartofaccount_purchase,
                'chartofaccount_payment' => $request->chartofaccount_payment
            ]);
        foreach($data as $key=>$value){            
                erp_po_inventory::create([
                    'po_id' => $request->id,
                    'product_id' =>$value['product_id'],                
                    'quantity' =>$value['quantity'],
                    'unit_price' =>$value['unit_price'],
                    'taxes' =>$value['taxes'],
                    'discount' =>$value['discount'],
                    'total_price' =>$value['total_price'],
                    'job' =>$value['job'],
                    'product_description' =>$value['product_description']
                ]);
            }     
            return 'Update';
      }else{
            $po = erp_purchase_order::create([
                    'vendor_id' => $request->vendor_id,
                    'user_id' => Auth::user()->id,
                    'po_date' => $request->po_date,
                    'goods_date' => $request->goods_date,
                    'po_status' => $request->po_status,
                    'shipment_status' => $request->shipment_status,
                    'total_po' => $request->total_po,
                    'ship_via' => $request->ship_via,
                    'chartofaccount_purchase' => $request->chartofaccount_purchase,
                    'chartofaccount_payment' => $request->chartofaccount_payment
                ]);
            foreach($data as $key=>$value){            
                    erp_po_inventory::create([
                        'po_id' => $po->id,
                        'product_id' =>$value['product_id'],                
                        'quantity' =>$value['quantity'],
                        'unit_price' =>$value['unit_price'],
                        'taxes' =>$value['taxes'],
                        'discount' =>$value['discount'],
                        'total_price' =>$value['total_price'],
                        'job' =>$value['job'],
                        'product_description' =>$value['product_description']
                    ]);
                }        
                return 'Save';
        }
    }

    public function editPurchaseOrder($id){
        return view('purchase_order.edit-purchase-order', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return erp_purchase_order::where('id', $id)->first();
        //return DB::select('call sp_editPurchaseOrderInfo('.Auth::user()->id.','.$id.')');
        //return DB::select("SELECT po.*, product.product_id, name.product_name FROM (SELECT * FROM erp_purchase_orders where id = ".$id.") AS po JOIN (SELECT id, po_id, product_id FROM erp_po_inventories) AS product on product.po_id = po.id JOIN (SELECT id, product_name FROM tblproduct_informations) AS name on name.id = product.product_id");

        //return erp_purchase_order::where('id', $id)->first();
    }

    public function editProductInfo($po_id){
        return DB::select("SELECT po.product_id, po.unit_price, po.quantity, po.taxes, po.discount, po.job, po.product_description, product.product_name FROM (SELECT id, product_id, unit_price, quantity, taxes, discount, job, product_description FROM erp_po_inventories where po_id = ".$po_id.") AS po JOIN (SELECT id, product_name FROM tblproduct_informations) AS product on product.id = po.product_id");
 
        //return erp_po_inventory::where('po_id', $po_id)->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        erp_purchase_order::where('id', $id)->delete();
        return "Your record delete permanently";
    }
}

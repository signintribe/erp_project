<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\erp_purchase_order;
use App\Models\Purchases\ErpChecklist;
use App\Models\Purchases\ErpPoDeliverycharge;
use App\Models\Purchases\ErpPoTax;
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

    public function getpurchaseOrder($parameters){
        $parms = json_decode($parameters,true);
        $pos = erp_purchase_order::where('company_id', $parms['company_id'])->skip($parms['offset'])->take($parms['limit'])->get();
        return response()->json([
            'status' => true,
            'message' => 'All Quotations',
            'data' => $pos
        ]);
    }

    public function get_po_poreceive($po_number, $status)
    {
        return DB::select('SELECT po.*, vendor.organization_name, product.product_name, quot.quotation_number FROM (SELECT * FROM erp_purchase_orders WHERE po_number = "'.$po_number.'" AND po_status = '.$status.') AS po LEFT JOIN(SELECT id, organization_name FROM erp_vendor_informations) AS vendor ON vendor.id = po.vendor_id LEFT JOIN (SELECT id, product_name FROM tblproduct_informations) AS product ON product.id = po.product_id LEFT JOIN (SELECT id, quotation_number FROM erp_quotation_purchases) AS quot on quot.id = po.quotation_id');
    }

    public function get_checklist($po_id)
    {
        return ErpChecklist::where('parent_id', $po_id)->get();
    }

    public function get_taxes($po_id)
    {
        $taxes = ErpPoTax::where('parent_id', $po_id)->get();
        $totalTaxes = DB::select('SELECT ROUND(SUM(tax_percentage), 2) as TotalTax FROM erp_po_taxes WHERE parent_id = '.$po_id.'');
        return response()->json([
            'taxes' => $taxes,
            'totalTax' => $totalTaxes[0]->TotalTax
        ]);
    }

    public function get_logistics($po_id)
    {
        $logistics = ErpPoDeliverycharge::where('parent_id', $po_id)->get();
        $totalCharges = DB::select('SELECT ROUND(SUM(delivery_charges)) AS totalCharges FROM erp_po_deliverycharges WHERE parent_id = '.$po_id.'');
        return response()->json([
            'logistics' => $logistics,
            'total_delivery_charges' => $totalCharges[0]->totalCharges
        ]);
    }

    public function savePurchaseOrder(Request $request){
        //return $request->all();
        if($request->id){
            $podata = $request->except(['id', 'company_id', 'created_at', 'organization_name', 'quotation_number', 'updated_at', 'user_id', 'total_delivery_charges', 'logistic_type', 'checklist', 'logistics', 'tax_details', 'vendor', 'product_name', 'apply_to']);
            erp_purchase_order::where('id', $request->id)->update($podata);
            
            if(!empty($request->tax_details)){
                $tax_details = json_decode($request->tax_details,true);
                ErpPoTax::where('parent_id', $request->id)->delete();
                foreach($tax_details as $tkey=>$tvalue){
                    ErpPoTax::create([
                        'parent_id' => $request->id,
                        'tax_name' => $tvalue['tax_name'],
                        'tax_percentage' => $tvalue['tax_percentage']
                    ]);
                }
            }
            if(!empty($request->logistics)){
                $logisticscharges = json_decode($request->logistics,true);
                ErpPoDeliverycharge::where('parent_id', $request->id)->delete();
                foreach($logisticscharges as $lkey=>$lvalue){
                    ErpPoDeliverycharge::create([
                        'parent_id' => $request->id,
                        'logistic_type' => $lvalue['logistic_type'],
                        'delivery_charges' => $lvalue['delivery_charges']
                    ]);
                }
            }
            if(!empty($request->checklist)){
                $checklist = json_decode($request->checklist,true);
                ErpChecklist::where('parent_id', $request->id)->delete();
                foreach($checklist as $ckey=>$cvalue){
                    ErpChecklist::create([
                        'parent_id' => $request->id,
                        'checklist' => $cvalue,
                    ]);
                }
            }
            $message = "Purchase Order Update";
            $status = true;
        }else{
            if(empty(erp_purchase_order::where('po_number', $request->po_number)->first())){
                $podata = $request->except(['total_delivery_charges', 'logistic_type', 'checklist', 'logistics', 'tax_details', 'vendor', 'product_name', 'apply_to']);
                $podata['company_id'] = session('company_id');
                $podata['user_id'] = Auth::user()->id;
                $po = erp_purchase_order::create($podata);

                $tax_details = json_decode($request->tax_details,true);
                foreach($tax_details as $tkey=>$tvalue){
                    ErpPoTax::create([
                        'parent_id' => $po->id,
                        'tax_name' => $tvalue['tax_name'],
                        'tax_percentage' => $tvalue['tax_percentage']
                    ]);
                }

                $logisticscharges = json_decode($request->logistics,true);
                foreach($logisticscharges as $lkey=>$lvalue){
                    ErpPoDeliverycharge::create([
                        'parent_id' => $po->id,
                        'logistic_type' => $lvalue['logistic_type'],
                        'delivery_charges' => $lvalue['delivery_charges']
                    ]);
                }

                $checklist = json_decode($request->checklist,true);
                foreach($checklist as $ckey=>$cvalue){
                    ErpChecklist::create([
                        'parent_id' => $po->id,
                        'checklist' => $cvalue,
                    ]);
                }
                $message = "Purchase Order Save";
                $status = true;
            }else{
                $message = "This PO Number Already Exist Please Use Another";
                $status = false;
            }
        }
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
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
        $po = DB::select('SELECT po.*, quot.quotation_number, vendor.organization_name, prod.product_name FROM (SELECT * FROM erp_purchase_orders WHERE id='.$id.') AS po JOIN(SELECT id, quotation_number FROM erp_quotation_purchases) AS quot ON quot.id = po.quotation_id JOIN(SELECT id, organization_name FROM erp_vendor_informations) AS vendor ON vendor.id = po.vendor_id JOIN(SELECT id, product_name FROM tblproduct_informations) AS prod ON prod.id = po.product_id');
        $checklist = ErpChecklist::where('parent_id', $id)->get();
        $taxdetail = ErpPoTax::where('parent_id', $id)->get();
        $totalTax = ErpPoTax::where('parent_id', $id)->sum('tax_percentage');
        $delivery = ErpPoDeliverycharge::where('parent_id', $id)->get();
        $totaldelivery = ErpPoDeliverycharge::where('parent_id', $id)->sum('delivery_charges');
        return response()->json([
            'status' => true,
            'po' => $po,
            'checklist' => $checklist,
            'taxdetail' => $taxdetail,
            'totalTax' => round($totalTax,2),
            'delivery' => $delivery,
            'total_delivery_charges' => $totaldelivery
        ]);
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
        ErpPoTax::where('parent_id', $id)->delete();
        ErpPoDeliverycharge::where('parent_id', $id)->delete();
        ErpChecklist::where('parent_id', $id)->delete();
        erp_purchase_order::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Your record delete permanently'
        ]);
    }
}

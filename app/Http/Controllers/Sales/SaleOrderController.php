<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales\erp_sale_order;
use App\Models\Sales\ErpSoChecklist;
use App\Models\Sales\ErpSoDeliverycharge;
use App\Models\Sales\ErpSoTax;
use Auth;
use DB;
class SaleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->id){
            $sodata = $request->except(['id', 'customer_name', 'company_id', 'created_at', 'customer_name', 'quotation_number', 'updated_at', 'user_id', 'total_delivery_charges', 'logistic_type', 'checklist', 'logistics', 'tax_details', 'customer', 'product_name', 'apply_to']);
            erp_sale_order::where('id', $request->id)->update($sodata);
            
            if(!empty($request->tax_details)){
                $tax_details = json_decode($request->tax_details,true);
                ErpSoTax::where('parent_id', $request->id)->delete();
                foreach($tax_details as $tkey=>$tvalue){
                    ErpSoTax::create([
                        'parent_id' => $request->id,
                        'tax_name' => $tvalue['tax_name'],
                        'tax_percentage' => $tvalue['tax_percentage']
                    ]);
                }
            }
            if(!empty($request->logistics)){
                $logisticscharges = json_decode($request->logistics,true);
                ErpSoDeliverycharge::where('parent_id', $request->id)->delete();
                foreach($logisticscharges as $lkey=>$lvalue){
                    ErpSoDeliverycharge::create([
                        'parent_id' => $request->id,
                        'logistic_type' => $lvalue['logistic_type'],
                        'delivery_charges' => $lvalue['delivery_charges']
                    ]);
                }
            }
            if(!empty($request->checklist)){
                $checklist = json_decode($request->checklist,true);
                ErpSoChecklist::where('parent_id', $request->id)->delete();
                foreach($checklist as $ckey=>$cvalue){
                    ErpSoChecklist::create([
                        'parent_id' => $request->id,
                        'checklist' => $cvalue,
                    ]);
                }
            }
            $message = "Purchase Order Update";
            $status = true;
        }else{
            if(empty(erp_sale_order::where('so_number', $request->so_number)->first())){
                $sodata = $request->except(['total_delivery_charges', 'customer_name', 'logistic_type', 'checklist', 'logistics', 'tax_details', 'customer', 'product_name', 'apply_to']);
                $sodata['company_id'] = session('company_id');
                $sodata['user_id'] = Auth::user()->id;
                $so = erp_sale_order::create($sodata);

                $tax_details = json_decode($request->tax_details,true);
                foreach($tax_details as $tkey=>$tvalue){
                    ErpSoTax::create([
                        'parent_id' => $so->id,
                        'tax_name' => $tvalue['tax_name'],
                        'tax_percentage' => $tvalue['tax_percentage']
                    ]);
                }

                $logisticscharges = json_decode($request->logistics,true);
                foreach($logisticscharges as $lkey=>$lvalue){
                    ErpSoDeliverycharge::create([
                        'parent_id' => $so->id,
                        'logistic_type' => $lvalue['logistic_type'],
                        'delivery_charges' => $lvalue['delivery_charges']
                    ]);
                }

                $checklist = json_decode($request->checklist,true);
                foreach($checklist as $ckey=>$cvalue){
                    ErpSoChecklist::create([
                        'parent_id' => $so->id,
                        'checklist' => $cvalue,
                    ]);
                }
                $message = "Sale Order Save";
                $status = true;
            }else{
                $message = "This SO Number Already Exist Please Use Another";
                $status = false;
            }
        }
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($parameters)
    {
        $parms = json_decode($parameters,true);
        $pos = erp_sale_order::where('company_id', $parms['company_id'])->skip($parms['offset'])->take($parms['limit'])->get();
        return response()->json([
            'status' => true,
            'message' => 'All Quotations',
            'data' => $pos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $so = DB::select('SELECT so.*, quot.quotation_number, customer.customer_name, prod.product_name FROM (SELECT * FROM erp_sale_orders WHERE id='.$id.') AS so LEFT JOIN(SELECT id, quotation_number FROM erp_quotation_sales) AS quot ON quot.id = so.quotation_id LEFT JOIN(SELECT id, customer_name FROM erp_customer_informations) AS customer ON customer.id = so.customer_id LEFT JOIN(SELECT id, product_name FROM tblproduct_informations) AS prod ON prod.id = so.product_id');
        $checklist = ErpSoChecklist::where('parent_id', $id)->get();
        $taxdetail = ErpSoTax::where('parent_id', $id)->get();
        $totalTax = ErpSoTax::where('parent_id', $id)->sum('tax_percentage');
        $delivery = ErpSoDeliverycharge::where('parent_id', $id)->get();
        $totaldelivery = ErpSoDeliverycharge::where('parent_id', $id)->sum('delivery_charges');
        return response()->json([
            'status' => true,
            'so' => $so,
            'checklist' => $checklist,
            'taxdetail' => $taxdetail,
            'totalTax' => round($totalTax,2),
            'delivery' => $delivery,
            'total_delivery_charges' => $totaldelivery
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ErpSoTax::where('parent_id', $id)->delete();
        ErpSoDeliverycharge::where('parent_id', $id)->delete();
        ErpSoChecklist::where('parent_id', $id)->delete();
        erp_sale_order::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Your record delete permanently'
        ]);
    }

    public function get_sale_order($pending_so, $status)
    {
        return DB::select('SELECT so.*, customer.customer_name, product.product_name, quot.quotation_number FROM (SELECT * FROM erp_sale_orders WHERE so_number = "'.$pending_so.'" AND so_status = '.$status.') AS so LEFT JOIN(SELECT id, customer_name FROM erp_customer_informations) AS customer ON customer.id = so.customer_id LEFT JOIN (SELECT id, product_name FROM tblproduct_informations) AS product ON product.id = so.product_id LEFT JOIN (SELECT id, quotation_number FROM erp_quotation_purchases) AS quot on quot.id = so.quotation_id');
    }

    public function get_checklist($so_id)
    {
        return ErpSoChecklist::where('parent_id', $so_id)->get();
    }

    public function get_taxes($so_id)
    {
        $taxes = ErpSoTax::where('parent_id', $so_id)->get();
        $totalTaxes = DB::select('SELECT ROUND(SUM(tax_percentage), 2) as TotalTax FROM erp_so_taxes WHERE parent_id = '.$so_id.'');
        return response()->json([
            'taxes' => $taxes,
            'totalTax' => $totalTaxes[0]->TotalTax
        ]);
    }
    
    public function get_logistics($so_id)
    {
        $logistics = ErpSoDeliverycharge::where('parent_id', $so_id)->get();
        $totalCharges = DB::select('SELECT ROUND(SUM(delivery_charges)) AS totalCharges FROM erp_so_deliverycharges WHERE parent_id = '.$so_id.'');
        return response()->json([
            'logistics' => $logistics,
            'total_delivery_charges' => $totalCharges[0]->totalCharges
        ]);
    }
}

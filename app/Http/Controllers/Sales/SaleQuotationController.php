<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales\ErpQuotationSale;
use App\Models\Sales\ErpQuotationSaleChecklist;
use App\Models\Sales\ErpQuotationSaleTax;
use App\Models\Sales\ErpQuotationSaleDeliverycharge;
use DB;

class SaleQuotationController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sales/quotation-sale');
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
            $data = $request->except(['id', 'applied_entity', 'total_delivery_charges', 'checklist', 'company_id', 'created_at', 'logistics', 'customer_name', 'product_name', 'tax_details', 'updated_at']);
            $quotation = ErpQuotationSale::where('id', $request->id)->update($data);
            if(!empty($request->checklist)){
                ErpQuotationSaleChecklist::where('parent_id', $request->id)->delete();
                $checklist = json_decode($request->checklist,true);
                foreach($checklist as $value){
                    ErpQuotationSaleChecklist::create([
                        'parent_id'=>$request->id,
                        'checklist'=>$value
                    ]);
                }
            }

            if(!empty($request->tax_details)){
                ErpQuotationSaleTax::where('parent_id', $request->id)->delete();
                $taxdetail = json_decode($request->tax_details,true);
                foreach ($taxdetail as $key => $value) {
                    ErpQuotationSaleTax::create([
                        'parent_id'=>$request->id,
                        'tax_name' => $value['tax_name'],
                        'tax_percentage' => $value['tax_percentage']
                    ]);
                }
            }

            if(!empty($request->logistics)){
                ErpQuotationSaleDeliverycharge::where('parent_id', $request->id)->delete();
                $logisticscharges = json_decode($request->logistics,true);
                foreach($logisticscharges as $lkey=>$lvalue){
                    ErpQuotationSaleDeliverycharge::create([
                        'parent_id' => $request->id,
                        'logistic_type' => $lvalue['logistic_type'],
                        'delivery_charges' => $lvalue['delivery_charges']
                    ]);
                }
            }
        }else{
            $data = $request->except(['tax_details', 'logistics', 'checklist', 'applied_entity', 'logistic_type', 'product_name', 'total_delivery_charges', 'customer_name']);
            $data['company_id'] = session('company_id');
            $quotation = ErpQuotationSale::create($data);

            if(!empty($request->tax_details)){
                $tax_details = json_decode($request->tax_details,true);
                foreach($tax_details as $tkey=>$tvalue){
                    ErpQuotationSaleTax::create([
                        'parent_id' => $quotation->id,
                        'tax_name' => $tvalue['tax_name'],
                        'tax_percentage' => $tvalue['tax_percentage']
                    ]);
                }
            }

            if(!empty($request->logistics)){
                $logisticscharges = json_decode($request->logistics,true);
                foreach($logisticscharges as $lkey=>$lvalue){
                    ErpQuotationSaleDeliverycharge::create([
                        'parent_id' => $quotation->id,
                        'logistic_type' => $lvalue['logistic_type'],
                        'delivery_charges' => $lvalue['delivery_charges']
                    ]);
                }
            }

            if(!empty($request->checklist)){
                $checklist = json_decode($request->checklist,true);
                foreach($checklist as $ckey=>$cvalue){
                    ErpQuotationSaleChecklist::create([
                        'parent_id' => $quotation->id,
                        'checklist' => $cvalue,
                    ]);
                }
            }
        }
        return response()->json([
            'status' => true,
            'message' => "Quotation Save Successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($parmeters)
    {
        $parms = json_decode($parmeters,true);
        $quotation = ErpQuotationSale::where('company_id', $parms['company_id'])->skip($parms['offset'])->take($parms['limit'])->get();
        return response()->json([
            'status' => true,
            'message' => 'All Quotations',
            'data' => $quotation
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
        $quotation = DB::select('call sp_getsalequotations('.$id.')');
        $chceklist = ErpQuotationSaleChecklist::where('parent_id', $id)->get();
        $taxes = ErpQuotationSaleTax::where('parent_id', $id)->get();
        $totalTax = ErpQuotationSaleTax::where('parent_id', $id)->sum('tax_percentage');
        $delivery = ErpQuotationSaleDeliverycharge::where('parent_id', $id)->get();
        $totaldelivery = ErpQuotationSaleDeliverycharge::where('parent_id', $id)->sum('delivery_charges');
        return response()->json([
            'status'=>true,
            'quotation' => $quotation[0],
            'checklist' => $chceklist,
            'taxes' => $taxes,
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
        //
    }
}

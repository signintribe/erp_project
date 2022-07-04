<?php

namespace App\Http\Controllers\Purchases;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchases\ErpQuotationPurchase;
use App\Models\Purchases\ErpQuotationChecklist;
use App\Models\Purchases\ErpQuotationTax;
use App\Models\Purchases\ErpQuotationDeliverycharge;
use DB;
class PurchaseQuotationController extends Controller
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
        return view('purchases.quotation-purchases');
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
        //return $request->all();
        //return $taxdetail = json_decode($request->tax_details,true);
        if($request->id){
            $data = $request->except(['id', 'applied_entity', 'total_delivery_charges', 'checklist', 'company_id', 'created_at', 'logistics', 'organization_name', 'product_name', 'tax_details', 'updated_at']);
            $quotation = ErpQuotationPurchase::where('id', $request->id)->update($data);
            if(!empty($request->checklist)){
                ErpQuotationChecklist::where('parent_id', $request->id)->delete();
                $checklist = json_decode($request->checklist,true);
                foreach($checklist as $value){
                    ErpQuotationChecklist::create([
                        'parent_id'=>$request->id,
                        'checklist'=>$value
                    ]);
                }
            }

            if(!empty($request->tax_details)){
                ErpQuotationTax::where('parent_id', $request->id)->delete();
                $taxdetail = json_decode($request->tax_details,true);
                foreach ($taxdetail as $key => $value) {
                    ErpQuotationTax::create([
                        'parent_id'=>$request->id,
                        'tax_name' => $value['tax_name'],
                        'tax_percentage' => $value['tax_percentage']
                    ]);
                }
            }

            if(!empty($request->logistics)){
                ErpQuotationDeliverycharge::where('parent_id', $request->id)->delete();
                $logisticscharges = json_decode($request->logistics,true);
                foreach($logisticscharges as $lkey=>$lvalue){
                    ErpQuotationDeliverycharge::create([
                        'parent_id' => $request->id,
                        'logistic_type' => $lvalue['logistic_type'],
                        'delivery_charges' => $lvalue['delivery_charges']
                    ]);
                }
            }
        }else{
            $data = $request->except(['tax_details', 'logistics', 'checklist', 'applied_entity', 'logistic_type', 'product_item', 'total_delivery_charges', 'organization_name']);
            $data['company_id'] = session('company_id');
            $quotation = ErpQuotationPurchase::create($data);

            if(!empty($request->tax_details)){
                $tax_details = json_decode($request->tax_details,true);
                foreach($tax_details as $tkey=>$tvalue){
                    ErpQuotationTax::create([
                        'parent_id' => $quotation->id,
                        'tax_name' => $tvalue['tax_name'],
                        'tax_percentage' => $tvalue['tax_percentage']
                    ]);
                }
            }

            if(!empty($request->logistics)){
                $logisticscharges = json_decode($request->logistics,true);
                foreach($logisticscharges as $lkey=>$lvalue){
                    ErpQuotationDeliverycharge::create([
                        'parent_id' => $quotation->id,
                        'logistic_type' => $lvalue['logistic_type'],
                        'delivery_charges' => $lvalue['delivery_charges']
                    ]);
                }
            }

            if(!empty($request->checklist)){
                $checklist = json_decode($request->checklist,true);
                foreach($checklist as $ckey=>$cvalue){
                    ErpQuotationChecklist::create([
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
        $quotation = ErpQuotationPurchase::where('company_id', $parms['company_id'])->skip($parms['offset'])->take($parms['limit'])->get();
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
        $quotation = DB::select('call sp_getquotations('.$id.')');
        $chceklist = ErpQuotationChecklist::where('parent_id', $id)->get();
        $taxes = ErpQuotationTax::where('parent_id', $id)->get();
        $totalTax = ErpQuotationTax::where('parent_id', $id)->sum('tax_percentage');
        $delivery = ErpQuotationDeliverycharge::where('parent_id', $id)->get();
        $totaldelivery = ErpQuotationDeliverycharge::where('parent_id', $id)->sum('delivery_charges');
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
        ErpQuotationTax::where('parent_id', $id)->delete();
        ErpQuotationChecklist::where('parent_id', $id)->delete();
        ErpQuotationDeliverycharge::where('parent_id', $id)->delete();
        ErpQuotationPurchase::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => "Quotation Delete Permanently"
        ]);
    }

    public function get_quotations($applied_to)
    {
        return ErpQuotationPurchase::where('quotation_number', $applied_to)->get();
    }
}

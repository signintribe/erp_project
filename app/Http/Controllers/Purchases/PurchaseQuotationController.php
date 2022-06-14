<?php

namespace App\Http\Controllers\Purchases;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchases\ErpQuotationPurchase;
use App\Models\Purchases\ErpQuotationChecklist;
use App\Models\Purchases\ErpQuotationTax;

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
        if($request->id){
            $data = $request->except(['id','check_list', 'taxes']);
            $quotation = ErpQuotationPurchase::where('id', $request->id)->update($data);
            if(!empty($request->check_list)){
                ErpQuotationChecklist::where('quotation_id', $request->id)->delete();
                foreach($request->check_list as $value){
                    ErpQuotationChecklist::create([
                        'quotation_id'=>$request->id,
                        'check_list'=>$value
                    ]);
                }
            }

            if(!empty($request->taxes)){
                ErpQuotationTax::where('quotation_id', $request->id)->delete();
                foreach ($request->taxes as $key => $value) {
                    ErpQuotationTax::create([
                        'quotation_id'=>$request->id,
                        'tax_name' => $value['tax_name'],
                        'percentage_tax' => $value['percentage_tax'],
                        'tax_amount' => $value['tax_amount']
                    ]);
                }
            }
        }else{
            $data = $request->except(['check_list', 'taxes']);
            $quotation = ErpQuotationPurchase::create($data);
            if(!empty($request->check_list)){
                foreach($request->check_list as $value){
                    ErpQuotationChecklist::create([
                        'quotation_id'=>$quotation->id,
                        'check_list'=>$value
                    ]);
                }
            }

            if(!empty($request->taxes)){
                foreach ($request->taxes as $key => $value) {
                    ErpQuotationTax::create([
                        'quotation_id'=>$quotation->id,
                        'tax_name' => $value['tax_name'],
                        'percentage_tax' => $value['percentage_tax'],
                        'tax_amount' => $value['tax_amount']
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
    public function show($id)
    {   
        $quotation = ErpQuotationPurchase::where('company_id', $id)->skip(0)->take(10)->get();
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
        //
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
        ErpQuotationTax::where('quotation_id', $id)->delete();
        ErpQuotationChecklist::where('quotation_id', $id)->delete();
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

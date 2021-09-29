<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreationTire\ErpCompanyTax;
use DB;
class CompanyTaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function taxesView()
    {
        return view('company.taxes-view');
    }
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
            $data = $request->except(['id', 'created_at', 'updated_at', 'company_id']);
            ErpCompanyTax::where('id', $request->id)->update($data);
        }else{
            $data = $request->all();
            ErpCompanyTax::create($data);
        }
        return "Your company taxes information save";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return $id;
        $taxes = DB::select('SELECT author.authority_name,  libacc.CategoryName as liabAcc, expacc.CategoryName as expAcc, taxes.* FROM (SELECT * FROM erp_company_taxes WHERE company_id = '.$id.') AS taxes JOIN(SELECT id, authority_name FROM erp_authorities WHERE company_id = '.$id.') AS author ON author.id = taxes.tax_authority JOIN(SELECT id, CategoryName FROM tblaccountcategories) AS libacc ON libacc.id = taxes.liability_head JOIN(SELECT id, CategoryName FROM tblaccountcategories) AS expacc ON expacc.id = taxes.expanse_head');
        return response()->json([
            'status'=>true,
            'message'=>'All Taxes',
            'data'=>$taxes
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
        $tax = ErpCompanyTax::where('id', $id)->first();
        $tax->company_id = (int)$tax->company_id;
        $tax->expanse_head = (int)$tax->expanse_head;
        $tax->liability_head = (int)$tax->liability_head;
        $tax->end_limit = (float)$tax->end_limit;
        $tax->start_limit = (float)$tax->start_limit;
        $tax->tax_percentage = (float)$tax->tax_percentage;
        return $tax;
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
        ErpCompanyTax::where('id', $id)->delete();
        return "This Record Delete Permanently";
    }
}

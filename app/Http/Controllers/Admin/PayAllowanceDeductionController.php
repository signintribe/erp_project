<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\erp_maintain_deduction;

class PayAllowanceDeductionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('call sp_getPayAllowance('.Auth::user()->id.', 0)');
    }

    public function pay_allownce()
    {
        return view('employee_center.pay-allownce-deduction');
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
        return $request->all();

        
        /* if($request->id){
            $data = $request->except(['id', 'department_id', 'company_id','group_name', 'office_id','office_name','company_name', 'department_name', 'created_at', 'updated_at']);
            erp_maintain_deduction::where('id', $request->id)->update($data);
            return "Pay, Allownance and Deducation Update Successfully";
        }else{
            $data = $request->except('office_id', 'department_id');
            erp_maintain_deduction::create($data);
        } */
        return "Pay, Allownance and Deducation Save Successfully";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return DB::select('call sp_getPayAllowance('.Auth::user()->id.', '.$id.')');
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
        erp_maintain_deduction::where('id', $id)->delete();
        return 'Pay, Allownance and Deducation Delete Permanently';
    }
}

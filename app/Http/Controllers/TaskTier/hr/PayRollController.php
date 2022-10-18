<?php

namespace App\Http\Controllers\TaskTier\hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskTire\hr\PayrollPay;
use App\Models\TaskTire\hr\ErpPayrolls;
use App\Models\TaskTire\hr\PayrollAllowance;
use App\Models\TaskTire\hr\PayrollDeduction;
use App\Models\TaskTire\hr\PayrollLibility;
use Auth;
class PayRollController extends Controller
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
        return view('TaskTier.hr.pay-roll');
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
        $data = $request->except(['allowance', 'prpays', 'deduct', 'employee', 'libility']);
        $data['company_id'] = session('company_id');
        $data['user_id'] = Auth::user()->id;
        $payroll = ErpPayrolls::create($data);
        $pays = json_decode($request->prpays, false);
        $employees = json_decode($request->employee, false);
        foreach ($pays as $k => $v) {
            foreach ($employees as $key => $value) {
                $paydata[] = array(
                    'erp_pay_id' => $v,
                    'tblemployeeinformation_id' => $value,
                    'erp_payroll_id' => $payroll->id
                );
            }
        }
        PayrollPay::insert($paydata);

        $allowance = json_decode($request->allowance, false);
        foreach ($allowance as $k => $v) {
            foreach ($employees as $key => $value) {
                $allowancedata[] = array(
                    'erp_allowance_id' => $v,
                    'tblemployeeinformation_id' => $value,
                    'erp_payroll_id' => $payroll->id
                );
            }
        }
        PayrollAllowance::insert($allowancedata);

        $deduct = json_decode($request->deduct, false);
        foreach ($deduct as $k => $v) {
            foreach ($employees as $key => $value) {
                $deductiondata[] = array(
                    'erp_deduction_id' => $v,
                    'tblemployeeinformation_id' => $value,
                    'erp_payroll_id' => $payroll->id
                );
            }
        }
        PayrollDeduction::insert($deductiondata);

        $libility = json_decode($request->libility, false);
        foreach ($libility as $k => $v) {
            foreach ($employees as $key => $value) {
                $libilitydata[] = array(
                    'erp_libility_id' => $v,
                    'tblemployeeinformation_id' => $value,
                    'erp_payroll_id' => $payroll->id
                );
            }
        }
        PayrollLibility::insert($libilitydata);
        return response()->json([
            'status' => ture,
            'message' => 'Your Payroll Save Successfully'
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
        //
    }
}

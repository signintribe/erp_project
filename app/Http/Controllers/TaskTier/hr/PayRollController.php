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
use DB;
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
        $chkpr = ErpPayrolls::where('group_id', $request->group_id)->where('payment_type', $request->payment_type)->first();
        if(!empty($chkpr)){
            return response()->json([
                'status' => false,
                'message' => 'Payroll is already assigned on this payment type please use another payment type of this employee group'
            ]);
        }
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
    public function show($array)
    {
        $vals = json_decode($array, true);
        return $payroll = DB::select('SELECT payroll.*, office.office_name, dept.department_name, groups.group_name FROM(SELECT * FROM erp_payrolls WHERE company_id = '.$vals['company_id'].') AS payroll JOIN(SELECT id,office_name FROM tblmaintain_offices)AS office ON office.id=payroll.office_id JOIN(SELECT id, department_name FROM tbldepartmens)AS dept ON dept.id=payroll.department_id JOIN(SELECT id, group_name FROM erp_employee_groups)AS groups ON groups.id=payroll.group_id LIMIT '.$vals['offset'].', '.$vals['limit'].'');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ErpPayrolls::with(['office', 'department', 'group'])->find($id);
        //$payrollpay = PayrollPay::with('pays')->where('erp_payrolls_id', $id)->get();
        $payrollpay = DB::select('SELECT payrollpay.id, payrollpay.erp_payrolls_id, payrollpay.tblemployeeinformation_id, payrollpay.erp_pays_id, erppay.pay_type, erppay.pay_amount, emp.first_name, emp.middle_name, emp.last_name FROM (SELECT * FROM payroll_pays WHERE erp_payrolls_id = '.$id.') AS payrollpay JOIN(SELECT id, pay_type, pay_amount FROM erp_pays) AS erppay ON erppay.id = payrollpay.erp_pays_id JOIN(SELECT id, first_name, middle_name, last_name FROM tblemployeeinformations) AS emp ON emp.id = payrollpay.tblemployeeinformation_id;');
        //$payrollallowance = PayrollAllowance::with('payrollallowance')->where('erp_payrolls_id', $id)->get();
        $payrollallowance = DB::select('SELECT payrollallow.id, payrollallow.erp_payrolls_id, payrollallow.tblemployeeinformation_id, payrollallow.erp_allowance_id, erpallow.allowance_type, erpallow.allow_amount, emp.first_name, emp.middle_name, emp.last_name FROM (SELECT * FROM payroll_allowances WHERE erp_payrolls_id = '.$id.') AS payrollallow JOIN(SELECT id, allowance_type, allow_amount FROM erp_allowances) AS erpallow ON erpallow.id = payrollallow.erp_allowance_id JOIN(SELECT id, first_name, middle_name, last_name FROM tblemployeeinformations) AS emp ON emp.id = payrollallow.tblemployeeinformation_id;');
        $payrolllibility = DB::select('SELECT payrolllibility.id, payrolllibility.erp_payrolls_id, payrolllibility.tblemployeeinformation_id, payrolllibility.erp_libility_id, erplib.libility_type, erplib.libility_amount, emp.first_name, emp.middle_name, emp.last_name FROM (SELECT * FROM payroll_libilities WHERE erp_payrolls_id = '.$id.') AS payrolllibility JOIN(SELECT id, libility_type, libility_amount FROM erp_libilities) AS erplib ON erplib.id = payrolllibility.erp_libility_id JOIN(SELECT id, first_name, middle_name, last_name FROM tblemployeeinformations) AS emp ON emp.id = payrolllibility.tblemployeeinformation_id;');
        $payrollded = DB::select('SELECT payrolldeduction.id, payrolldeduction.erp_payrolls_id, payrolldeduction.tblemployeeinformation_id, payrolldeduction.erp_deduction_id, erpded.deduct_type, erpded.deduct_amount, emp.first_name, emp.middle_name, emp.last_name FROM (SELECT * FROM payroll_deductions WHERE erp_payrolls_id = '.$id.') AS payrolldeduction JOIN(SELECT id, deduct_type, deduct_amount FROM erp_deductions) AS erpded ON erpded.id = payrolldeduction.erp_deduction_id JOIN(SELECT id, first_name, middle_name, last_name FROM tblemployeeinformations) AS emp ON emp.id = payrolldeduction.tblemployeeinformation_id;');
        return response()->json([
            'status' => true,
            'data' => $data, 
            'payrollpay' => $payrollpay, 
            'payrollallowance' => $payrollallowance,
            'payrolllibility' => $payrolllibility,
            'payrollded' => $payrollded
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

use App\Models\erp_maintain_deduction;
use App\Models\CreationTire\HumanResources\ErpPayAllowance;
use App\Models\CreationTire\HumanResources\ErpPay;
use App\Models\CreationTire\HumanResources\ErpAllowance;
use App\Models\CreationTire\HumanResources\ErpDeduction;
use App\Models\CreationTire\HumanResources\ErpLibility;

class PayAllowanceDeductionController extends Controller
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
        //return DB::select('call sp_getPayAllowance('.Auth::user()->id.', 0)');
        return ErpPayAllowance::with('allowances')->get();
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
        if ($request->id) {
            return $this->update($request->except(['company_id', 'user_id']));
        } else {
            try{
                $chk = ErpPayAllowance::where('department_id', $request->department_id)->get();
                if (count($chk) > 0) {
                    return response()->json([
                        'status'=>false,
                        'message'=>'Pay and Allowance is already define for this department'
                    ]);
                } else {
                    $payallowance =  $request->except(['allowances', 'deductions', 'libilities', 'pays']);
                    $payallowance['user_id'] = Auth::user()->id;
                    $payallowance['company_id'] = session('company_id');
                    $saveallowance = ErpPayAllowance::create($payallowance);
    
                    $pays = json_decode($request->pays, false);
                    $allowances = json_decode($request->allowances, false);
                    $deductions = json_decode($request->deductions, false);
                    $libilities = json_decode($request->libilities, false);
                    foreach ($pays as $key => $value) {
                        $pay = array('erp_pay_allowance_id'=>$saveallowance->id, 'pay_type'=> $value->pay_type, 'pay_emp_account'=>$value->pay_emp_account, 'pay_amount'=>$value->pay_amount, 'pay_com_account'=>$value->pay_com_account);
                        ErpPay::create($pay);
                    }
    
    
                    foreach ($allowances as $key => $value) {
                        $allowance = array('erp_pay_allowance_id'=>$saveallowance->id, 'allowance_type'=> $value->allowance_type, 'allow_emp_account'=>$value->allow_emp_account, 'allow_amount'=>$value->allow_amount, 'allow_com_account'=>$value->allow_com_account);
                        ErpAllowance::create($allowance);
                    }
    
    
                    foreach ($deductions as $key => $value) {
                        $deduction = array('erp_pay_allowance_id'=>$saveallowance->id, 'deduct_type'=> $value->deduct_type, 'deduct_emp_account'=>$value->deduct_emp_account, 'deduct_amount'=>$value->deduct_amount, 'deduct_com_account'=>$value->deduct_com_account);
                        ErpDeduction::create($deduction);
                    }
    
                    foreach ($libilities as $key => $value) {
                        $libility = array('erp_pay_allowance_id'=>$saveallowance->id, 'libility_type'=> $value->libility_type, 'libility_emp_account'=>$value->libility_emp_account, 'libility_amount'=>$value->libility_amount, 'libility_com_account'=>$value->libility_com_account);
                        ErpLibility::create($libility);
                    }
    
                    /* if($request->id){
                        $data = $request->except(['id', 'department_id', 'company_id','group_name', 'office_id','office_name','company_name', 'department_name', 'created_at', 'updated_at']);
                        erp_maintain_deduction::where('id', $request->id)->update($data);
                        return "Pay, Allownance and Deducation Update Successfully";
                    }else{
                        $data = $request->except('office_id', 'department_id');
                        erp_maintain_deduction::create($data);
                    } */
                }
                $status = true; $message = 'Pay and Allownance Save Successfully';
            }catch (\Illuminate\Database\QueryException $e) {
                $status = false; $message = $e->errorInfo[2];
            }
            return response()->json([
                'status' => $status,
                'message' => $msssage
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($pageinfo)
    {
        $pg = json_decode($pageinfo, true);
        $chk = ErpPayAllowance::where('company_id', $pg['company_id'])->get();
        if (!empty($chk)) {
            $allowanc = DB::select('SELECT allow.*, office.office_name, dept.department_name FROM (SELECT * FROM erp_pay_allowances WHERE company_id = '.$pg['company_id'].') AS allow JOIN(SELECT id, office_name FROM tblmaintain_offices) AS office ON office.id = allow.office_id JOIN(SELECT id, department_name FROM tbldepartmens) AS dept ON dept.id = allow.department_id LIMIT '.$pg['offset'].', '.$pg['limit'].'');
            return response()->json([
                'status' => true,
                'message' => 'All Records',
                'data' => $allowanc
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Record is not found'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return ErpPayAllowance::with(['allowances','pays','libilities','deductions'])->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($request)
    {
        try {
            $payallowance = ErpPayAllowance::where('id', $request['id'])->first();
            $payallowance->office_id = $request['office_id'];
            $payallowance->department_id = $request['department_id'];
            $payallowance->save();

            $allownaces = json_decode($request['allowances'], false);
            foreach ($allownaces as $key => $value) {
                if (!isset($value->id)) {
                    $allowance = array('erp_pay_allowance_id'=>$request['id'], 'allowance_type'=> $value->allowance_type, 'allow_emp_account'=>$value->allow_emp_account, 'allow_amount'=>$value->allow_amount, 'allow_com_account'=>$value->allow_com_account);
                    ErpAllowance::create($allowance);
                } else {
                    $allowance = array('allowance_type'=> $value->allowance_type, 'allow_emp_account'=>$value->allow_emp_account, 'allow_amount'=>$value->allow_amount, 'allow_com_account'=>$value->allow_com_account);
                    ErpAllowance::where('id', $value->id)->update($allowance);
                }
            }

            $pays = json_decode($request['pays'], false);
            foreach ($pays as $key => $value) {
                if (isset($value->id)) {
                    $pay = array('pay_type'=> $value->pay_type, 'pay_emp_account'=>$value->pay_emp_account, 'pay_amount'=>$value->pay_amount, 'pay_com_account'=>$value->pay_com_account);
                    ErpPay::where('id', $value->id)->update($pay);
                } else {
                    $pay = array('erp_pay_allowance_id'=>$request['id'], 'pay_type'=> $value->pay_type, 'pay_emp_account'=>$value->pay_emp_account, 'pay_amount'=>$value->pay_amount, 'pay_com_account'=>$value->pay_com_account);
                    ErpPay::create($pay);
                }
            }

            $deduction = json_decode($request['deductions'], false);
            foreach ($deduction as $key => $value) {
                if (isset($value->id)) {
                    $deduction = array('deduct_type'=> $value->deduct_type, 'deduct_emp_account'=>$value->deduct_emp_account, 'deduct_amount'=>$value->deduct_amount, 'deduct_com_account'=>$value->deduct_com_account);
                    ErpDeduction::where('id', $value->id)->update($deduction);
                } else {
                    $deduction = array('erp_pay_allowance_id'=>$request['id'], 'deduct_type'=> $value->deduct_type, 'deduct_emp_account'=>$value->deduct_emp_account, 'deduct_amount'=>$value->deduct_amount, 'deduct_com_account'=>$value->deduct_com_account);
                    ErpDeduction::create($deduction);
                }
            }

            $libilities = json_decode($request['libilities'], false);
            foreach ($libilities as $key => $value) {
                if (isset($value->id)) {
                    $libility = array('libility_type'=> $value->libility_type, 'libility_emp_account'=>$value->libility_emp_account, 'libility_amount'=>$value->libility_amount, 'libility_com_account'=>$value->libility_com_account);
                    ErpLibility::where('id', $value->id)->update($libility);
                } else {
                    $libility = array('erp_pay_allowance_id'=>$request['id'], 'libility_type'=> $value->libility_type, 'libility_emp_account'=>$value->libility_emp_account, 'libility_amount'=>$value->libility_amount, 'libility_com_account'=>$value->libility_com_account);
                    ErpLibility::create($libility);
                }
            }
            $status = true; $message = 'Pay and allowance update sccessfully';
        } catch (\Illuminate\Database\QueryException $e) {
            $status = false; $message = $e->errorInfo[2];
        }
        return response()->json([
            'status' => $status,
            'message' => $msssage
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ErpLibility::where('erp_pay_allowance_id', $id)->delete();
        ErpPay::where('erp_pay_allowance_id', $id)->delete();
        ErpAllowance::where('erp_pay_allowance_id', $id)->delete();
        ErpDeduction::where('erp_pay_allowance_id', $id)->delete();
        ErpPayAllowance::where('id', $id)->delete();
        /*  erp_maintain_deduction::where('id', $id)->delete(); */
        return 'Pay, Allownance and Deducation Delete Permanently';
    }

    public function get_all_payallowance($dept_id)
    {
        $allAllowance = ErpPayAllowance::where('department_id', $dept_id)->with(['allowances','pays','libilities','deductions'])->first();
        if (!empty($allAllowance)) {
            return response()->json([
                'status' => true,
                'data' => $allAllowance,
                'message' => 'All Allowance'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Allowance Not Found'
            ]);
        }
    }
}

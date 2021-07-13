<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\erp_employee_payscale;
use Auth;
use DB;
class PayScaleController extends Controller
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
        return DB::select('call sp_getAllEmployeePayscale('.Auth::user()->id.', 0)');
    }

    public function employee_payscale()
    {
        return view('admin.employee-payscale');
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
            $data = $request->except(['id', 'department_id', 'company_id', 'group_name','office_id','office_name','company_name', 'department_name']);
            $data['status'] = $data['status'] == 'true' ? 1 : 0;
            erp_employee_payscale::where('id', $request->id)->update($data);
            return "Employee Payscale Update Successfully";
        }else{
            $data = $request->except(['company_id', 'department_id', 'office_id']);
            $data['status'] = $data['status'] == 'true' ? 1 : 0;
            erp_employee_payscale::create($data);
            return "Employee Payscale Save Successfully";
        }
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
        return DB::select('call sp_getAllEmployeePayscale('.Auth::user()->id.', '.$id.')');
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
        erp_employee_payscale::where('id', $id)->delete();
        return 'Employee Payscale delete Permanently';
    }
}

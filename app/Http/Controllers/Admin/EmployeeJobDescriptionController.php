<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\employeeCenter\erp_employee_job_description;
use App\Models\VendorModels\tblcompanydetail;

class EmployeeJobDescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = tblcompanydetail::select('id')->where('user_id', Auth::user()->id)->first();
        return DB::select('call sp_getEmployeeJobDescription(0, '.$company->id.')');
       //return DB::select('SELECT job.*, emp.first_name FROM (SELECT id, first_name FROM tblemployeeinformations) AS emp JOIN (SELECT * FROM erp_employee_job_descriptions)AS job ON job.employee_id = emp.id WHERE job.user_id = '.Auth::user()->id.'');

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
        if($request->id){
            $data = $request->except(['id', 'company_id', 'user_id', 'office_id','office_name','company_name', 'department_name', 'created_at', 'updated_at']);
            erp_employee_job_description::where('id', $request->id)->update($data);
            return "Job Description Update successfully";
        }else{
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            //return $data;
            erp_employee_job_description::create($data);
        }
        return "Job Description saved successfully";
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
        return erp_employee_job_description::where('id', $id)->first();
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
        erp_employee_job_description::where('id', $id)->delete();
        return "Your record delete permanently";
    }
}

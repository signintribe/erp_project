<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\employeeCenter\erp_employee_certification;
use Auth;
use DB;
use App\Models\employeeCenter\tblemployeeinformation;

class EmployeeCertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return erp_employee_certification::get();
       // return DB::select('SELECT e.first_name, edu.* FROM tblemployeeinformations AS e JOIN erp_employee_certifications AS edu ON edu.employee_id = e.id');

        return DB::select('SELECT cert.*, employee.first_name FROM (SELECT * FROM erp_employee_certifications WHERE user_id = '.Auth::user()->id.') AS cert JOIN(SELECT id, first_name FROM tblemployeeinformations) AS employee ON employee.id = cert.employee_id');
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
            $data = $request->all();
            erp_employee_certification::where('id', $request->id)->update($data);
            return "Employee Certification Update";
        }else{
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            erp_employee_certification::create($data);
        }
        return "Employee Certification Save";
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
        return erp_employee_certification::where('id', $id)->first();
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
        erp_employee_certification::where('id', $id)->delete();
        return "Employee Certification Delete";
    }
}

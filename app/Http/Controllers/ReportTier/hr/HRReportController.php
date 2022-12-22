<?php

namespace App\Http\Controllers\ReportTier\hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\employeeCenter\erp_employee_experience;
use DB;

class HRReportController extends Controller
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
        return view('ReportTier.hr.hr-report');
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
        //
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

    public function get_hr_report(Request $request)
    {
        if (isset($request->worked_country, $request->from_salary, $request->to_salary, $request->gender, $request->qualification, $request->living_country)) {
            $filter = DB::select('SELECT employee.id, employee.first_name, employee.last_name, employee.gender,address.country, quali.qualification_name, exper.worked_country, exper.salary, exper.worked_to, exper.worked_from FROM(SELECT id, first_name, last_name, gender FROM tblemployeeinformations) AS employee JOIN(SELECT employee_id, address_id FROM erp_employee_addresses) AS addid ON addid.employee_id = employee.id JOIN(SELECT id, country FROM tbladdresses)AS address ON address.id = addid.address_id JOIN(SELECT employee_id, qualification_name FROM erp_employee_educations)AS quali ON quali.employee_id = employee.id JOIN(SELECT employee_id, worked_country, salary, worked_to, worked_from FROM erp_employee_experiences) AS exper ON exper.employee_id = employee.id WHERE exper.worked_country = "'.$request->worked_country.'" AND exper.salary BETWEEN '.$request->to_salary.' AND '.$request->from_salary.' AND employee.gender = "'.$request->gender.'" AND quali.qualification_name LIKE "%'.$request->qualification.'%" AND address.country LIKE "%'.$request->living_country.'%" GROUP BY employee.id;');
        } else if(isset($request->from_salary, $request->to_salary)){
            $filter = erp_employee_experience::whereBetween('salary', [$request->to_salary, $request->from_salary])->get();
        } else if(isset($request->worked_country)){
            $filter = erp_employee_experience::where('worked_country', $request->worked_country)->get();
        }else if(isset($request->gender)){

        }

        return $filter;
    }
}

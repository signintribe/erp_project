<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\employeeCenter\erp_employee_assignment;
use Auth;
use DB;
use App\Models\VendorModels\tblcompanydetail;

class EmployeeOrganizationAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = tblcompanydetail::select('id')->where('user_id', Auth::user()->id)->first();
        return DB::select('call sp_getEmployeeOrgAssignment(0, '.$company->id.')');
        //return DB::select('select assi.*, emp.first_name from(select id, first_name from tblemployeeinformations) as emp join(select * from erp_employee_assignments) as assi on assi.employee_id = emp.id where assi.user_id = '.Auth::user()->id.'');
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
            $data = $request->except(['id', 'department_name', 'first_name', 'last_name', 'middle_name', 'sup_name', 'office_id', 'user_id', 'updated_at', 'created_at']);
            erp_employee_assignment::where('id', $request->id)->update($data);
            return "Employee assignment update successfully";
        }else{
            $data = $request->except('office_id');
            $data['user_id'] = Auth::user()->id;
            erp_employee_assignment::create($data);
        }
        return "Employee assignment save successfully";
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
        $company = tblcompanydetail::select('id')->where('user_id', Auth::user()->id)->first();
        return DB::select('call sp_getEmployeeOrgAssignment('.$id.', '.$company->id.')');
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
        erp_employee_assignment::where('id', $id)->delete();
        return 'Your record permanently delete';
    }
}

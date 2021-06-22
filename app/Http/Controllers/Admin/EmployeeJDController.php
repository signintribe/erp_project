<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\erp_employee_jd;
use DB;
use Auth;
class EmployeeJDController extends Controller
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
        return DB::select('call sp_getAllEmployeeJDS('.Auth::user()->id.', 0)');
    }

    public function employee_jd()
    {
        return view('admin.employee-jd');
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
        $imgname = "";
        if ($request->hasFile('jdDoc')) {
            $current = date('ymd') . rand(1, 999999) . time();
            $file = $request->file('jdDoc');
            $imgname = $current . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/employeeJD'), $imgname);
        }
        if($request->id){
            $data = $request->except(['id','jdDoc', 'company_id', 'office_id','office_name','company_name', 'department_name', 'created_at', 'updated_at']);        
            $data['attachment'] = $imgname == "" ? $request->attachment : $imgname;
            erp_employee_jd::where('id', $request->id)->update($data);
            return "Employee Job Description Update Successfully";
        }else{
            $data = $request->except(['company_id', 'office_id']); 
            $data['attachment'] = $imgname; 
            erp_employee_jd::create($data);
            return "Employee Job Description Save Successfully";
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
        return DB::select('call sp_getAllEmployeeJDS('.Auth::user()->id.', '.$id.')');
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
        erp_employee_jd::where('id', $id)->delete();
        return 'Employee Job Desc delete Permanently';
    }
}

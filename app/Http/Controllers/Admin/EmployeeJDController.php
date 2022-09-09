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
        return view('employee_center.employee-jd');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $r)
    {
        return $r->all();
        $jd = new erp_employee_jd();
        $jd->task_name = $r->task_name;
        $jd->task_sop = $r->task_sop;
        $jd->dose_repeat = $r->dose_repeat;
        $jd->attachment = $r->attachment;
        $jd->frequency_repeat =$r->frequency_repeat;
        $result = $js->save();
        if($result)
        {
            return response()->json([
                'message'=>'JDs successfully save',
                'status' => 'true'
            ]);
        }
        else
        {
            return response()->json([
                'message'=>'Jds not save',
                'status' => 'false'
            ]);
        }
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
            $data = $request->except(['id', 'department_id', 'jdDoc','group_name' ,'company_id', 'office_id','office_name','company_name', 'department_name', 'created_at', 'updated_at']);        
            $data['attachment'] = $imgname == "" ? $request->attachment : $imgname;
            erp_employee_jd::where('id', $request->id)->update($data);
            return "Employee Job Description Update Successfully";
        }else{
            $data = $request->except(['company_id', 'office_id', 'department_id']); 
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

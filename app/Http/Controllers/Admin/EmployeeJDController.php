<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\erp_employee_jd;
use App\Models\employeeCenter\erp_employee_job_description;
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
        $image = "";
        if ($request->hasFile('jdDoc')) {
            $current = date('ymd') . rand(1, 999999) . time();
            $file = $request->file('jdDoc');
            $imgname = $current . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/employeeJD'), $imgname);
            if($request->id){
                $file_path = public_path('/employeeJD' . $request->attachment);
                File::exists($file_path) ? File::delete($file_path) : '';
            }
        }
        if ($request->hasFile('sop')) {
            $current = date('ymd') . rand(1, 999999) . time();
            $file = $request->file('sop');
            $image = $current . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/employeeJD'), $image);
            if($request->id){
                $file_path = public_path('/employeeJD' . $request->jd_sop);
                File::exists($file_path) ? File::delete($file_path) : '';
            }
        }
        if($request->id){
            $data = $request->except(['id', 'description', 'company_id', 'user_id', 'sop', 'jdDoc', 'created_at', 'updated_at']);        
            $data['attachment'] = $imgname == "" ? $request->attachment : $imgname;
            $data['jd_sop'] = $image == "" ? $request->jd_sop : $image;
            erp_employee_jd::where('id', $request->id)->update($data);
            $descriptions = json_decode($request->description, true);
            foreach ($descriptions as $key => $value) {
                if(isset($value['id'])){
                    $ds = erp_employee_job_description::where('id', $value['id'])->first();
                }else{
                    $ds = new erp_employee_job_description();
                    $ds->jd_id = $request->id;
                }
                $ds->description = $value['description'];
                $ds->payallowance = $value['payallowance'];
                $ds->save();
            }
            return "Employee Job Description Update Successfully";
        }else{
            $data = $request->except([]); 
            $data['attachment'] = $imgname; 
            $data['jd_sop'] = $image; 
            $data['company_id'] = session('company_id');
            $data['user_id'] = Auth::user()->id;
            $jd = erp_employee_jd::create($data);
            $descriptions = json_decode($request->description, true);
            foreach ($descriptions as $key => $value) {
                $ds = new erp_employee_job_description();
                $ds->jd_id = $jd->id;
                $ds->description = $value['description'];
                $ds->payallowance = $value['payallowance'];
                $ds->save();
            }
            return "Employee Job Description Save Successfully";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  array  $array
     * @return \Illuminate\Http\Response
     */
    public function show($array)
    {
        $data = json_decode($array, true);
        return erp_employee_jd::where('company_id', $data['company_id'])->take($data['limit'])->skip($data['offset'])->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $emp_jd = erp_employee_jd::where('id', $id)->first();
        $emp_jd_description = erp_employee_job_description::where('jd_id', $id)->get();
        return response()->json([
            'status' => true,
            'jds' => $emp_jd,
            'description' => $emp_jd_description
        ]);
        //return DB::select('call sp_getAllEmployeeJDS('.Auth::user()->id.', '.$id.')');
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
        erp_employee_job_description::where('jd_id', $id)->delete();
        erp_employee_jd::where('id', $id)->delete();
        return 'Employee Job Desc delete Permanently';
    }
}

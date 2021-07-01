<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\erp_employee_tasks;
use App\Models\erp_tasks_assigned_details;
use App\Models\tblemployeeinformations;
use Auth;
use DB;
use File;
use App\Models\VendorModels\tblcompanydetail;

class EmployeeTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = tblcompanydetail::select('id')->where('user_id', Auth::user()->id)->first();
        return DB::select('call sp_getEmployeeTasks(0, '.$company->id.')');
        //return DB::select('SELECT taskdetails.*, employee.first_name FROM (SELECT * FROM erp_employee_tasks WHERE user_id = '.Auth::user()->id.') AS taskdetails JOIN(SELECT id, first_name FROM tblemployeeinformations) AS employee ON employee.id = taskdetails.employee_id');

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
        //return $request->attachment;
        if ($request->hasFile('attachment')) {
            $current= date('ymd').rand(1,999999).time();
            $file= $request->file('attachment');
            $imageName = $current.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('tasks_attachment'), $imageName);
            if(!empty($request->id)){
                $this->deleteOldImage($request->attachment);
                $tasks = erp_employee_tasks::where('id', $request->id)->first();
                $tasks->attachment = $imageName;
                $tasks->save();
            }
        }

        if($request->id){
            $tasks = $request->except('id','user_id','task_id','master_company','child_company','department_name','supervisor','supervisor_designation','created_at','updated_at');
            $assignedTasks= $request->except('id','employee_id','user_id','task_name','task_date','expected_date','completion_status','attachment','completion_date','delay_task','efficiency','negligency','save_days','created_at','updated_at');
            erp_employee_tasks::where('id', $request->id)->update($tasks);
            erp_tasks_assigned_details::where('task_id', $request->task_id)->update($assignedTasks);
        }else{
            $tasks = $request->except('task_id','master_company','child_company','department_name','supervisor','supervisor_designation');
            $assignedTasks= $request->except('employee_id','user_id','task_name','task_date','expected_date','completion_status','attachment','completion_date','delay_task','efficiency','negligency','save_days');
            $tasks['user_id'] = Auth::User()->id;
            $tasks = erp_employee_tasks::create($tasks);
            $assignedTasks['task_id'] =  $tasks->id;
            $assignedTasks = erp_tasks_assigned_details::create($assignedTasks);
        }
        return "Employee Tasks save Successfull";
    }

     /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function deleteOldImage($request)
    {
        if(File::exists(public_path('tasks_attachment/'.$request))){
            $file =public_path('tasks_attachment/'.$request);
            $img=File::delete($file);
        }
    }

    public function taskAssignedDetail($assigned_id){
        return erp_tasks_assigned_details::select('task_id','master_company','child_company','department_name','supervisor','supervisor_designation')->where('task_id', $assigned_id)->first();
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
        return erp_employee_tasks::where('id', $id)->first();
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
        $assign = erp_tasks_assigned_details::where('task_id', $id)->first();
        erp_tasks_assigned_details::where('task_id', $assign->task_id)->delete();
        $task = erp_employee_tasks::where('id', $id)->first();
        erp_employee_tasks::where('id', $id)->delete();
        return 'Task Details Delete Permanently';
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\erp_employee_tasks;
use App\Models\erp_tasks_assigned_details;
use Auth;
use DB;
use File;

class EmployeeTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $tasks = $request->except('id','user_id','task_id','master_company','child_company','department_name','supervisor','supervisor_designation');
            $assignedTasks= $request->except('id','employee_id','user_id','task_name','task_date','expected_date','completion_status','attachment','completion_date','delay_task','efficiency','negligency','save_days');
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
        return erp_tasks_assigned_details::select('task_id','master_company','child_company','department_name','supervisor','supervisor_designation')->where('id', $assigned_id)->first();
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
}

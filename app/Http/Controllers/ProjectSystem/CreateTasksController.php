<?php

namespace App\Http\Controllers\ProjectSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectSystem\ErpTask;
use DB;
class CreateTasksController extends Controller
{
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
        return view('project-system.tasks');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            $data = $request->except(['activity_id', 'company_id', 'created_at', 'id', 'project_id', 'phase_name', 'activity_name', 'project_name', 'updated_at']);
            ErpTask::where('id', $request->id)->update($data);
        }else{
            $data = $request->except(['activity_id', 'project_id']);
            ErpTask::create($data);
        }
        return response()->json([
            'status' => true,
            'message' => 'Task Information Save Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($array)
    {
        $data = json_decode($array,true);
        $task = DB::select('SELECT task.*, phase.activity_id, phase.phase_name, activity.project_id, activity.activity_name, project.project_name FROM(SELECT * FROM erp_tasks WHERE company_id = '.$data['company_id'].') AS task JOIN(SELECT id, phase_name, activity_id FROM erp_phases) AS phase on phase.id = task.phase_id JOIN(SELECT id, activity_name, project_id FROM erp_activities) AS activity ON activity.id = phase.activity_id JOIN(SELECT id, project_name FROM erp_projects) AS project ON project.id = activity.project_id LIMIT '.$data['offset'].', '.$data['limit'].'');
        return response()->json([
            'status' => true,
            'data' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = DB::select('SELECT task.*, phase.activity_id, phase.phase_name, activity.project_id, activity.activity_name, project.project_name FROM(SELECT * FROM erp_tasks WHERE id='.$id.' AND company_id = '.session('company_id').') AS task JOIN(SELECT id, phase_name, activity_id FROM erp_phases) AS phase on phase.id = task.phase_id JOIN(SELECT id, activity_name, project_id FROM erp_activities) AS activity ON activity.id = phase.activity_id JOIN(SELECT id, project_name FROM erp_projects) AS project ON project.id = activity.project_id');
        return response()->json([
            'status' => true,
            'data' => $task
        ]);
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
        ErpTask::where('id', $id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'Task information delete permanently'
        ]);
    }

    public function get_phases_tasks($task_id, $company_id)
    {
        $task = DB::select('SELECT task.*, phase.activity_id, phase.phase_name, activity.project_id, activity.activity_name, project.project_name FROM(SELECT * FROM erp_tasks WHERE phase_id='.$task_id.' AND company_id = '.session('company_id').') AS task JOIN(SELECT id, phase_name, activity_id FROM erp_phases) AS phase on phase.id = task.phase_id JOIN(SELECT id, activity_name, project_id FROM erp_activities) AS activity ON activity.id = phase.activity_id JOIN(SELECT id, project_name FROM erp_projects) AS project ON project.id = activity.project_id');
        return response()->json([
            'status' => true,
            'data' => $task
        ]);
    }
}

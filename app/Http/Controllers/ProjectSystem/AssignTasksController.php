<?php

namespace App\Http\Controllers\ProjectSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectSystem\ErpTasksAssignedDetail;
use App\Models\ProjectSystem\ErpProjectBudget;
use DB;
class AssignTasksController extends Controller
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
        return view('project-system.assign-tasks');
    }

    public function view_assigned_tasks()
    {
        return view('project-system.view-assigned-tasks');
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
            $data = $request->except(['$$hashKey', 'activity_name', 'assign_emp_name', 'created_at', 'id', 'phase_name', 'project_name', 'reported_emp_name', 'supervisor_name', 'task_name', 'updated_at', 'phase_id', 'activity_id', 'project_id', 'office_id', 'department_id']);
            ErpTasksAssignedDetail::where('id', $request->id)->update($data);
        }else{
            //return $request->all();
            $data = $request->except(['coa']);
            $project = ErpTasksAssignedDetail::create($data);
            $coa = explode(',', $request->coa);
            foreach($coa as $v){
                $b = new ErpProjectBudget();
                $b->erp_company_budget_id = $v;
                $b->erp_tasks_assigned_detail_id = $project->id;
                $b->save();
            }
        }
        return response()->json([
            'status' => true,
            'message' => "Save"
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
        $data = json_decode($array, true);
        $assignedTasks = DB::select('call getAssignedTasks('.$data['company_id'].', '.$data['offset'].', '.$data['limit'].')');
        return response()->json([
            'status' => true,
            'data' => $assignedTasks
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
        ErpTasksAssignedDetail::where('id', $id)->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Assigned Task Delete Permanently'
        ]);
    }

    public function get_department_office($group_id)
    {
        $data = DB::select('SELECT groups.department_id, groups.group_name, dept.office_id, dept.department_name FROM (SELECT id, department_id, group_name FROM erp_employee_groups WHERE id = '.$group_id.') AS groups JOIN(SELECT id, office_id, department_name FROM tbldepartmens) AS dept ON dept.id = groups.department_id');
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
}

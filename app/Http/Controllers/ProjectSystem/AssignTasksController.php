<?php

namespace App\Http\Controllers\ProjectSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectSystem\ErpTasksAssignedDetail;
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
        $data = $request->except(['phase_id', 'activity_id', 'project_id', 'office_id', 'department_id']);
        ErpTasksAssignedDetail::create($data);
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
}

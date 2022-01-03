<?php

namespace App\Http\Controllers\ProjectSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectSystem\ErpActivity;
use DB;
class CreateActivitiesControllerr extends Controller
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
        return view('project-system.activities');
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
            $udata = $request->except(['id', 'created_at', 'updated_at']);
            ErpActivity::where('id', $request->id)->update($udata);    
        }else{
            $data = $request->all();
            ErpActivity::create($data);
        }
        return response()->json([
            'status' => true,
            'message' => 'Activity of project save successfully'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($arr)
    {
        $data = json_decode($arr,true);
        $activity = DB::select('SELECT project.project_name, activity.* FROM (SELECT * FROM erp_activities WHERE company_id = '.$data['company_id'].') AS activity JOIN(SELECT id, project_name FROM erp_projects) AS project ON project.id = activity.project_id LIMIT '.$data['offset'].', '.$data['limit'].'');
        return response()->json([
            'status'=>true,
            'data'=>$activity
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
        $activity = ErpActivity::where('id', $id)->where('company_id', session('company_id'))->first();
        return response()->json([
            'status' => true,
            'message' => 'Activity',
            'data' => $activity
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
        ErpActivity::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Activity of project delete permannently'
        ]);
    }

    public function get_project_activities($project_id, $company_id)
    {
        $activities = ErpActivity::where('project_id', $project_id)->where('company_id', $company_id)->get();
        return response()->json([
            'status' => true,
            'data' => $activities
        ]);
    }
}

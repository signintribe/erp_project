<?php

namespace App\Http\Controllers\ProjectSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\ProjectSystem\ErpPhase;
use DB;
class CreatePhasesController extends Controller
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
        return view('project-system.phases');
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
            $phase = $request->except(['project_id', 'activity_name', 'company_id', 'created_at', 'id', 'project_name', 'updated_at']);
            ErpPhase::where('id', $request->id)->update($phase);
        }else{
            $phase = $request->except(['project_id']);
            ErpPhase::create($phase);    
        }
        return response()->json([
            'status' => true,
            'message' => 'Phase Infromation Save Successfully'
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
        $phases = DB::select('SELECT phases.*, activity.activity_name, activity.project_id, project.project_name FROM(SELECT * FROM erp_phases WHERE company_id = '.$data['company_id'].') AS phases JOIN(SELECT id, activity_name, project_id FROM erp_activities) AS activity ON activity.id = phases.activity_id JOIN(SELECT id, project_name FROM erp_projects) AS project ON project.id = activity.project_id LIMIT '.$data['offset'].', '.$data['limit'].'');
        return response()->json([
            'status' => true,
            'data' => $phases   
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
        $phase = $phases = DB::select('SELECT phases.*, activity.activity_name, activity.project_id, project.project_name FROM(SELECT * FROM erp_phases WHERE id='.$id.' AND company_id = '.session('company_id').') AS phases JOIN(SELECT id, activity_name, project_id FROM erp_activities) AS activity ON activity.id = phases.activity_id JOIN(SELECT id, project_name FROM erp_projects) AS project ON project.id = activity.project_id');
        return response()->json([
            'status' => true,
            'data' => $phase
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
        ErpPhase::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Phase Information Delete Permanently'
        ]);
    }

    public function get_activity_phases($activity_id, $company_id)
    {
        $phases = ErpPhase::where('activity_id', $activity_id)->where('company_id', $company_id)->get();
        return response()->json([
            'status' => true,
            'data' => $phases
        ]);
    }
}

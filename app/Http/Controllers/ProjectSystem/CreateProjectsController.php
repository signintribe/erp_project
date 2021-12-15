<?php

namespace App\Http\Controllers\ProjectSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectSystem\ErpProject;
use App\Models\ProjectSystem\ErpActivity;
class CreateProjectsController extends Controller
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
        return view('project-system.projects');
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
            $data = $request->except('company_id', 'created_at', 'updated_at', 'id');
            ErpProject::where('id', $request->id)->update($data);
        }else{
            $project = $request->all();
            ErpProject::create($project);
        }
        return response()->json([
            'status' => true,
            'message' => 'Project Information Save Successfull'
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
        $projects = ErpProject::where('company_id', $data['company_id'])->skip($data['offset'])->take($data['limit'])->get();
        return response()->json([
            'status' => true,
            'data' => $projects
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
        $project = ErpProject::where('id', $id)->first();
        return response()->json([
            'status'=>true,
            'data'=>$project
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
        $chk = ErpActivity::where('project_id', $id)->first();
        if(!empty($chk)){
            return response()->json([
                'status' => false,
                'message' => "Please delete its project of activities"
            ]);
        }else{
            ErpProject::where('id', $id)->delete();
            return response()->json([
                'status' => true,
                'message' => "Project information delete successfully"
            ]);
        }
    }
}

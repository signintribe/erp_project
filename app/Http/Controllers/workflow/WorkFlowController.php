<?php

namespace App\Http\Controllers\workflow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskTire\WorkFlow\ErpWorkflow;
use App\Models\TaskTire\WorkFlow\ErpWorkflowAction;
class WorkFlowController extends Controller
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
        return view('workflow.add-workflow');
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
        $data = $request->except(['attach_file', 'role_action', 'search']);
        $imgname = "";
        if ($request->hasFile('attach_file')) {
            $current = date('ymd') . rand(1, 999999) . time();
            $file = $request->file('attach_file');
            $imgname = $current . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/workflows'), $imgname);
            if($request->id){
                $this->deleteOldImage($request->attachment_file);
            }
        }
        $data['attachment_file'] = $imgname;
        $data['company_id'] = session('company_id');
        $wf = ErpWorkflow::create($data);
        $actions = json_decode($request->role_action);
        foreach ($actions as $key => $value) {
            ErpWorkflowAction::create([
                'flow_id' => $wf->id,
                'action' => $value
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Workflow Save Successfully'
        ]);
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

<?php

namespace App\Http\Controllers\TaskTier\workflow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\TaskTire\WorkFlow\ErpWorkflow;
use App\Models\TaskTire\WorkFlow\ErpWorkflowAction;
use App\Models\employeeCenter\tblemployeeinformation;
use App\Models\TaskTire\hr\ErpEmployeeLeave;
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
        return view('TaskTier.workflow.add-workflow');
    }

    public function view_workflow()
    {
        return view('TaskTier.workflow.view-workflow');
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
        //return $request->all();
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
        ErpWorkflowAction::where('flow_id', $id)->delete();
        ErpWorkflow::where('id', $id)->delete();
        return "Workflow Delete Permenantly";
    }

    /**
     * Get Workflows for notificateion and display all workflows
     * @return response workflows
     * @param string $workflowfor
     */
    public function get_workflow_notification($workflowfor)
    {
        if(Auth::user()->is_admin == 1){
            $workflow = ErpWorkflow::where('searchfor', $workflowfor)->where('company_id', session('company_id'))->get();
        }else{
            $roleId = tblemployeeinformation::select('role')->where('user_id', Auth::user()->id)->first();
            $workflow = ErpWorkflow::where('searchfor', $workflowfor)->where('company_id', session('company_id'))->where('assign_to', $roleId->role)->get();
        }
        return response()->json([
            'status' => true,
            'data' => $workflow
        ]);
    }

    public function get_all_workflows()
    {
        if(Auth::user()->is_admin == 1){
            $workflow = ErpWorkflow::where('company_id', session('company_id'))->get();
        }else{
            $roleId = tblemployeeinformation::select('role')->where('user_id', Auth::user()->id)->first();
            $workflow = ErpWorkflow::where('company_id', session('company_id'))->where('assign_to', $roleId->role)->get();
        }
        return response()->json([
            'status' => true,
            'data' => $workflow
        ]);
    }

    /**
     * Get specific workflow
     * @param int $id
     * @param string $searchfor
     * @return specific workflow
     */
    public function get_workflow($id, $searchfor)
    {
        if($searchfor == 'Leave'){
            $workflow = DB::select('SELECT wf.*, lv.fromdate, lv.todate, lv.avail_leave, lv.available_balance, lv.look_after, lv.total_leave, lv.description, lv.leave_status, yl.leave_type, user.name AS applied_name, emp.first_name AS lookafter_name FROM (SELECT * FROM erp_workflows WHERE id = '.$id.' AND searchfor = "'.$searchfor.'") AS wf JOIN(SELECT * FROM erp_employee_leaves) AS lv ON lv.id = wf.workflowfor JOIN(SELECT id, leave_type FROM erp_maintain_leaves) AS yl ON yl.id = lv.leave_id JOIN(SELECT id, name FROM users) AS user ON user.id = lv.user_id JOIN(SELECT id, first_name FROM tblemployeeinformations) AS emp on emp.id = lv.look_after;');
        }

        return response()->json([
            'status' => true,
            'data' => $workflow
        ]);
    }

    public function change_workflow_status($id, $searchfor, $workflowfor, $status)
    {
        ErpWorkflow::where('id', $id)->update([
            'status' => $status,
            'view_status' => 1
        ]);
        if($searchfor== 'Leave'){
            $lv = ErpEmployeeLeave::where('id', $workflowfor)->first();
            if($status == 2){
                $lv->available_balance = $lv->available_balance + $lv->avail_leave;
                $lv->prev_balance = $lv->prev_balance + $lv->avail_leave;
            }
            $lv->leave_status = $status;
            $lv->save();
        }
    }
}

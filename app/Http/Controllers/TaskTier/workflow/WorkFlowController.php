<?php

namespace App\Http\Controllers\TaskTier\workflow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\TaskTire\WorkFlow\ErpWorkflow;
use App\Models\TaskTire\WorkFlow\ErpWorkflowForward;
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
        if($request->flow_id){
            $data = $request->all();
            ErpWorkflowForward::create($data);
        }else{
            return "Save Workflow";
            $data = $request->except(['attach_file', 'search', 'action_id']);
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
            $data['user_id'] = Auth::user()->id;
            $wf = ErpWorkflow::create($data);
            $action = $request->except(['attach_file', 'search', 'description', 'forworded_date', 'searchfor', 'workflowfor']);
            $action['flow_id'] = $wf->id;
            ErpWorkflowForward::create($action);
            /* $actions = json_decode($request->role_action);
            foreach ($actions as $key => $value) {
                ErpWorkflowAction::create([
                    'flow_id' => $wf->id,
                    'action' => $value
                ]);
            } */
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
    public function show($array)
    {
        $ar = json_decode($array, 'false');
        return ErpWorkflow::where('company_id', $ar['company_id'])->where('user_id', Auth::user()->id)->skip($ar['offset'])->take($ar['limit'])->get();
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

    public function get_all_workflows($paginate, $location)
    {
        if($location == 'menu'){
            if(Auth::user()->is_admin == 1){
                $workflow = DB::select('SELECT wf.* FROM (SELECT * FROM erp_workflow_forwards) AS wff JOIN(SELECT * FROM erp_workflows) AS wf ON wf.id = wff.flow_id');
            }else{
                $roleId = tblemployeeinformation::select('role')->where('user_id', Auth::user()->id)->first();
                $workflow = DB::select('SELECT wf.* FROM (SELECT * FROM erp_workflow_forwards WHERE assign_to = '.$roleId->role.') AS wff JOIN(SELECT * FROM erp_workflows) AS wf ON wf.id = wff.flow_id');
            }
            $workflow = count($workflow);
        }else if($location == 'inbox'){
            $page = json_decode($paginate, 'false');
            if(Auth::user()->is_admin == 1){
                $workflow = DB::select('SELECT wf.* FROM (SELECT * FROM erp_workflow_forwards) AS wff JOIN(SELECT * FROM erp_workflows) AS wf ON wf.id = wff.flow_id LIMIT '.$page['offset'].', '.$page['limit'].'');
            }else{
                $roleId = tblemployeeinformation::select('role')->where('user_id', Auth::user()->id)->first();
                $workflow = DB::select('SELECT wf.* FROM (SELECT * FROM erp_workflow_forwards WHERE assign_to = '.$roleId->role.') AS wff JOIN(SELECT * FROM erp_workflows) AS wf ON wf.id = wff.flow_id LIMIT '.$page['offset'].', '.$page['limit'].'');
            }
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
        $checkList = array();
        $taxes = array();
        $deliverycharges = array();
        switch($searchfor){
            case 'Leave':
                $workflow = DB::select('SELECT wf.*, lv.fromdate, lv.todate, lv.avail_leave, lv.available_balance, lv.look_after, lv.total_leave, lv.description, lv.leave_status, yl.leave_type, user.name AS applied_name, emp.first_name AS lookafter_name FROM (SELECT * FROM erp_workflows WHERE id = '.$id.' AND searchfor = "'.$searchfor.'") AS wf JOIN(SELECT * FROM erp_employee_leaves) AS lv ON lv.id = wf.workflowfor JOIN(SELECT id, leave_type FROM erp_maintain_leaves) AS yl ON yl.id = lv.leave_id JOIN(SELECT id, name FROM users) AS user ON user.id = lv.user_id JOIN(SELECT id, first_name FROM tblemployeeinformations) AS emp on emp.id = lv.look_after');
                break;
            case 'Purchase_Quotation':
                $workflow = DB::select('SELECT wf.*, q.quotation_number, q.quotation_date, q.quotation_status, q.apply_to, q.applied_id, q.quotation_till, q.delivery_date, q.product_id, q.unit_price, q.quantity, q.gross_price, q.discount_name, q.discount_amount, q.net_amount, q.payment_type, q.advance_percentage, q.time_advance, prod.product_name FROM(
                                            SELECT * FROM erp_workflows WHERE id = '.$id.' AND searchfor = "'.$searchfor.'"
                                        ) AS wf JOIN(
                                            SELECT * FROM erp_quotation_purchases 
                                        ) AS q ON q.quotation_number = wf.workflowfor JOIN(
                                            SELECT id, product_name FROM tblproduct_informations) AS prod ON prod.id = q.product_id'
                                        );
                $checkList = DB::select('SELECT * FROM erp_quotation_checklists WHERE parent_id IN(SELECT id FROM erp_workflows WHERE workflowfor = '.$workflow[0]->quotation_number.')');
                $taxes = DB::select('SELECT * FROM erp_quotation_taxes WHERE parent_id IN(SELECT id FROM erp_workflows WHERE workflowfor = '.$workflow[0]->quotation_number.')');
                $deliverycharges = DB::select('SELECT * FROM erp_quotation_deliverycharges WHERE parent_id IN(SELECT id FROM erp_workflows WHERE workflowfor = '.$workflow[0]->quotation_number.')');
                break;

            case 'Tender':
                return $searchfor;
                break;
            case 'Requestion':
                return $searchfor;
                break;
            case 'Sale_Order':
                return $searchfor;
                break;
            case 'Sale_Quotation':
                return $searchfor;
                break;
            case 'Task':
                return $searchfor;
                break;
            default:
                return 'Wrong input';
        }
        $forwards = DB::select('SELECT fw.flow_id, office.office_name, dept.department_name AS forword_to, act.action, role.role_name FROM (SELECT * FROM erp_workflow_forwards WHERE flow_id = '.$id.') AS fw JOIN (SELECT id, office_name FROM tblmaintain_offices) AS office ON office.id = fw.office_id JOIN(SELECT id, department_name FROM tbldepartmens) AS dept ON dept.id = fw.forword_to JOIN(SELECT id, action FROM erp_role_actions) AS act ON act.id = fw.action_id JOIN(SELECT id, role_name FROM erp_employee_roles) AS role ON role.id = fw.assign_to');
        return response()->json([
            'status' => true,
            'data' => $workflow,
            'checklist' => $checkList,
            'taxes' => $taxes,
            'deliverycharges' => $deliverycharges,
            'forwards' => $forwards
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

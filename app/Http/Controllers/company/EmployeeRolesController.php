<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreationTire\Company\ErpRoleAction;
use App\Models\CreationTire\Company\ErpEmployeeRole;
use DB;
class EmployeeRolesController extends Controller
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
        return view('company.employee-roles');
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
            $role = $request->except(['role_action', 'company_id']);
            ErpEmployeeRole::where('id', $request->id)->update($role);
            $actions = json_decode($request->role_action);
            if(!empty($actions)){
                ErpRoleAction::where('role_id', $request->id)->delete();
                foreach($actions as $value){
                    ErpRoleAction::create([
                        'role_id'=>$request->id,
                        'action'=>$value
                    ]);
                }
            }
        }else{
            $role = $request->except(['role_action']);
            $role['company_id'] = session('company_id');
            $roleid = ErpEmployeeRole::create($role);
            $actions = json_decode($request->role_action);
            if(!empty($actions)){
                foreach($actions as $value){
                    ErpRoleAction::create([
                        'role_id'=>$roleid->id,
                        'action'=>$value
                    ]);
                }
            }
        }
        return response()->json([
            'status' => true,
            'message' => 'Role Save Successfully'
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
        $roles = DB::select('SELECT roles.*, office.office_name, dept.department_name FROM (SELECT * FROM erp_employee_roles WHERE company_id='.$id.') AS roles JOIN(SELECT id, office_name FROM tblmaintain_offices) AS office ON office.id = roles.office_id JOIN(SELECT id, department_name FROM tbldepartmens)AS dept ON dept.id = roles.department_id;');
        return response()->json([
            'status' => true,
            'data' => $roles
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
        $role = ErpEmployeeRole::where('id', $id)->first();
        $actions = ErpRoleAction::where('role_id', $id)->get();
        return response()->json([
            'status' => true,
            'role' => $role,
            'actions' => $actions
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
        ErpRoleAction::where('role_id', $id)->delete();
        ErpEmployeeRole::where('id', $id)->delete();
        return "Role Delete Permanently";
    }

    public function get_employee_roles($dept_id)
    {
        return ErpEmployeeRole::where('department_id', $dept_id)->get();
    }
    
    public function get_role_actions($role_id)
    {
        return ErpRoleAction::where('role_id', $role_id)->get();
    }
}

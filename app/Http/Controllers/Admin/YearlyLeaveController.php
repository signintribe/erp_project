<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\erp_maintain_leave;
use App\Models\CreationTire\Company\ErpLeavePenality;
class YearlyLeaveController extends Controller
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
        return DB::select('call sp_getAllYearlyLeaves('.Auth::user()->id.', 0);');
    }

    public function yearly_leave()
    {
        return view('admin.yearly-leave');
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
        if($request->id){
            $data = $request->except(['id','jdDoc', 'checklist', 'company_id','group_name', 'office_id','office_name','company_name', 'department_name', 'created_at', 'updated_at']);
            $data['carry_forword'] = $request->carry_forword == true ? 1 : 0;
            $data['encash'] = $request->encash == true ? 1 : 0;
            erp_maintain_leave::where('id', $request->id)->update($data);
            $penalities = json_decode($request->checklist);
            if(!empty($penalities)){
                ErpLeavePenality::where('leave_id', $request->id)->delete();
                foreach ($penalities as $key => $value) {
                    ErpLeavePenality::create([
                        'leave_id'=>$request->id,
                        'penality' => $value
                    ]);
                }
            }
            return "Employee Yearly Leaves Update";
        }else{
            $data = $request->except(['company_id', 'office_id', 'checklist']);
            $data['carry_forword'] = $request->carry_forword == true ? 1 : 0;
            $data['encash'] = $request->encash == true ? 1 : 0;
            $leave = erp_maintain_leave::create($data);
            $penalities = json_decode($request->checklist);
            if(!empty($penalities)){
                foreach ($penalities as $key => $value) {
                    ErpLeavePenality::create([
                        'leave_id'=>$leave->id,
                        'penality' => $value
                    ]);
                }
                return "Employee Yearly Leaves Save";
            }
        }
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
        $leave = DB::select('call sp_getAllYearlyLeaves('.Auth::user()->id.', '.$id.');');
        $penality = ErpLeavePenality::where('leave_id', $leave[0]->id)->get();
        return response()->json([
            'leave' => $leave,
            'penality' => $penality
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
        ErpLeavePenality::where('leave_id', $id)->delete();
        erp_maintain_leave::where('id', $id)->delete();
        return 'Yearly Leave Info Deleted';
    }
}

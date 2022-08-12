<?php

namespace App\Http\Controllers\hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\TaskTire\hr\ErpEmployeeLeave;
class ApplyLeaveController extends Controller
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
        return view('hr.apply-leave-form');
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
        $data = $request->except(['proof']);
        $data['prev_balance'] = $request->available_balance;
        $data['user_id'] = Auth::user()->id;
        $data['company_id'] = session('company_id');
        //return $data;
        $imgname = "";
        if ($request->hasFile('proof')) {
            $current = date('ymd') . rand(1, 999999) . time();
            $file = $request->file('proof');
            $imgname = $current . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/leave_proof'), $imgname);
            $data['proof_attachment'] = $imgname;
            if($request->id){
                $this->deleteOldImage($request->category_image);
            }
        }
        ErpEmployeeLeave::create($data);
        return "Save";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $alleave = DB::select('SELECT lv.*, lookafter.first_name, leaves.leave_type FROM (SELECT * FROM erp_employee_leaves WHERE company_id = '.$id.' AND user_id = '.Auth::user()->id.') AS lv JOIN(SELECT id, first_name FROM tblemployeeinformations) AS lookafter ON lookafter.id = lv.look_after JOIN(SELECT id, leave_type FROM erp_maintain_leaves) AS leaves ON leaves.id = lv.leave_id');
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

    public function get_leaves_for_apply()
    {
        return DB::select('SELECT * FROM erp_maintain_leaves WHERE department_id IN(SELECT department_id FROM tblemployeeinformations WHERE user_id = '.Auth::user()->id.')');
    }

    /**
     * Get Previous leave balance
     */
    public function prev_employee_leave_balance($company_id, $leave_id)
    {
        return $balace = ErpEmployeeLeave::where('company_id', $company_id)->where('user_id', Auth::user()->id)->where('leave_id', $leave_id)->first();
    }
}

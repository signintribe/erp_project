<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\erp_maintain_leave;
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
        if($request->id){
            $data = $request->except(['id','jdDoc', 'company_id', 'office_id','office_name','company_name', 'department_name', 'created_at', 'updated_at']);
            erp_maintain_leave::where('id', $request->id)->update($data);
            return "Employee Yearly Leaves Update";
        }else{
            $data = $request->except(['company_id', 'office_id']);
            erp_maintain_leave::create($data);
            return "Employee Yearly Leaves Save";
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
        return DB::select('call sp_getAllYearlyLeaves('.Auth::user()->id.', '.$id.');');
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
        erp_maintain_leave::where('id', $id)->delete();
        return 'Yearly Leave Info Deleted';
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\erp_maintain_shift;
class CompanyShiftController extends Controller
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
        return DB::select('call sp_getAllcompanyShift('.Auth::user()->id.', 0)');
    }

    public function company_shift()
    {
        return view('admin.company-shift');
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
            $data = $request->except('company_name', 'company_id', 'department_name', 'office_name', 'office_id');
            erp_maintain_shift::where('id', $request->id)->update($data);
            return "Shift update successfully";
        }else{
            $data = $request->all();
            erp_maintain_shift::create($data);
            return "Shift save successfully";
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
        return DB::select('call sp_getAllcompanyShift('.Auth::user()->id.', '.$id.')');
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
        erp_maintain_shift::where('id', $id)->delete();
        return 'Company Shifts Delete permanently';
    }

    public function get_shift($dept_id)
    {
        return erp_maintain_shift::where('department_id', $dept_id)->get();
    }

    public function edit_shift($dept_id)
    {
        return erp_maintain_shift::where('department_id', $dept_id)->first();
    }
}

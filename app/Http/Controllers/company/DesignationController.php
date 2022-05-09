<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ErpDesignation;
use App\Models\erp_employee_group;
use DB;

class DesignationController extends Controller
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
        return view('company/designation-form');
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
        $data = $request->except(['attachment', 'office_id', 'department_id']);
        if ($request->hasFile('attachment')) {
            $current = date('ymd') . rand(1, 999999) . time();
            $file = $request->file('attachment');
            $imgname = $current . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/designation_files'), $imgname);
            $data['designation_attaches'] = $imgname;
            if($request->id){
                $file_path = public_path("designation_files/" . $request->designation_attaches);
                File::exists($file_path) ? File::delete($file_path) : '';
            }
        }
        ErpDesignation::create($data);
        return response()->json([
            'status' => 'true',
            'message' => 'Designation Information Save Successfully'
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
        return DB::select('call sp_getAllEmployeeDesignation('.$id.', 0)');;
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
        ErpDesignation::where('id', $id)->delete();
        return "Delete Permanently";
    }

    public function get_employee_group($dept_id)
    {
        return erp_employee_group::where('department_id', $dept_id)->get();;
    }
}

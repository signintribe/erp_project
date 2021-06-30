<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\erp_gazzeted_holiday;

class GazzetedHolidayController extends Controller
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
        return DB::select('call sp_getAllGazzetedHoliday('.Auth::user()->id.', 0)');
    }

    public function gazzeted_holiday()
    {
        return view('admin.gazzeted-holiday');
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
            $data = $request->except(['id','jdDoc', 'company_id', 'group_name', 'office_id','office_name','company_name', 'department_name', 'created_at', 'updated_at']);
            erp_gazzeted_holiday::where('id', $request->id)->update($data);
            return "Gazzeted Holiday Update";
        }
        $data = $request->except(['company_id', 'office_id']);
        erp_gazzeted_holiday::create($data);
        return "Gazzeted Holiday Save";
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
        return DB::select('call sp_getAllGazzetedHoliday('.Auth::user()->id.', '.$id.')');
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
        erp_gazzeted_holiday::where('id', $id)->delete();
        return 'Gazzete Holiday Info Delete Permanently';
    }
}

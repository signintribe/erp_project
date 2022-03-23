<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tbldepartmen;
use App\Models\tblcompany_calender;
use Auth;
use DB;
class CompanyCalenderController extends Controller
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
        return view('company.company-calander');
    }

    public function editCalender($id){
        return view('company.edit-company-calender', compact('id'));
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
        try{
            if($request->id){
                $data = $request->except('id','office_id', 'company_name', 'company_id', 'office_name', 'department_name');
                tblcompany_calender::where('id', $request->id)->update($data);
            }else{
                $data = $request->all();
                $data['office_id'] = (int)$data['office_id'];
                tblcompany_calender::create($data);
            }
            return response()->json(['status' => true, 'message' => "Calender Save"]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status' => false, 'message' => $e->errorInfo[2]]);
        }
    }

    public function get_departments($office_id){
        return tbldepartmen::where('office_id', $office_id)->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DB::select('call sp_getAllcompanyCalendar('.$id.', 0)');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return DB::select('call sp_getAllcompanyCalendar('.Auth::user()->id.', '.$id.')');
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
        tblcompany_calender::where('id', $id)->delete();
        return 'Calender delete Successfully';
    }

    public function get_calendar($dept_id)
    {
        return tblcompany_calender::where('department_id', $dept_id)->get();
    }

    public function edit_calendar($dept_id)
    {
        return tblcompany_calender::where('department_id', $dept_id)->first();
    }
}

<?php

namespace App\Http\Controllers\Tender;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tender\ErpTender;
use DB;
class TenderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tender.tender-information');
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
                $data = $request->except(['office_id', '$$hashKey', 'company_id', 'created_at', 'department_name', 'id', 'office_name', 'updated_at']);\
                App\Models\Tender\ErpTender::where('id', $request->id)->update($data);
            }else{
                $data = $request->except(['office_id']);
                ErpTender::create($data);
            }
            return response()->json(['status' => true, 'message' => 'Tender Information Save Successfully']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status' => false, 'message' => substr($e->errorInfo[2], 0, 68)]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($array)
    {
        try{
            $data = json_decode($array,true);
            $tenders = DB::select('SELECT tenders.*, dept.department_name, office.id as office_id, office.office_name FROM(SELECT * FROM erp_tenders WHERE company_id = '.$data['company_id'].') AS tenders JOIN(SELECT id, office_id, department_name FROM tbldepartmens) AS dept ON dept.id = tenders.department_id JOIN(SELECT id, office_name FROM tblmaintain_offices) AS office ON office.id = dept.office_id LIMIT '.$data['offset'].', '.$data['limit'].';');
            return response()->json(['status' => true, 'message' => 'All Tenders', 'data' => $tenders]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status' => false, 'message' => substr($e->errorInfo[2], 0, 68)]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tenders = DB::select('SELECT tenders.*, dept.department_name, office.id as office_id, office.office_name FROM(SELECT * FROM erp_tenders WHERE id = '.$id.') AS tenders JOIN(SELECT id, office_id, department_name FROM tbldepartmens) AS dept ON dept.id = tenders.department_id JOIN(SELECT id, office_name FROM tblmaintain_offices) AS office ON office.id = dept.office_id');
        return response()->json(['status' => true, 'message' => 'All Tenders', 'data' => $tenders]);
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
        try{
            ErpTender::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'Tender Information Delete Permanently']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status' => false, 'message' => substr($e->errorInfo[2], 0, 68)]);
        }
    }

    public function get_tenders_for_quotations($tender_name)
    {
        return ErpTender::where('tender_name', 'LIKE', $tender_name.'%')->get();
    }
}

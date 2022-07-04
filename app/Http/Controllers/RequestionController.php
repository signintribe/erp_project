<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ErpRequestion;
use Auth;
use DB;
class RequestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $data = $request->except(['$$hashKey', 'created_at', 'id', 'product_name', 'requested_dept', 'requested_person_name', 'updated_at', 'user_id']);
            ErpRequestion::where('id', $request->id)->update($data);
        }else{
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            ErpRequestion::create($data);
        }
        return response()->json(['status'=>true, 'message'=>'Requestion Request Send Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DB::select('SELECT req.*, prod.product_name, emp.first_name AS requested_person_name FROM(SELECT * FROM erp_requestions WHERE department='.$id.') AS req JOIN(SELECT id, product_name FROM tblproduct_informations) AS prod ON prod.id = req.product JOIN (SELECT id, first_name FROM tblemployeeinformations) AS emp ON emp.id=req.requested_person');
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
        ErpRequestion::where('id', $id)->delete();
        return "Your Request Delete Permanently";
    }

    public function changeStatus($request_id, $status)
    {
        $req = ErpRequestion::where('id', $request_id)->first();
        $req->status = $status;
        $req->save();
        return "Request Status Changed";
    }

    public function get_requestion_for_quotation($requestion)
    {
        return ErpRequestion::where('requestion_no', $requestion)->get();
        /* $products = DB::select("SELECT req.id, product.product_name as requestion_name FROM(SELECT id, product_id, resource_id FROM erp_requestions WHERE company_id = ".session('company_id').")AS req JOIN(SELECT id, product_name FROM tblproduct_informations WHERE product_name LIKE '".$requestion."%')AS product ON product.id = req.product_id GROUP BY req.product_id;");
        if(!empty($products)){
            return $products;
        }else{
            $resourec = DB::select("SELECT req.id, emp.first_name as requestion_name FROM(SELECT id, product_id, resource_id FROM erp_requestions WHERE company_id =  ".session('company_id').")AS req JOIN(SELECT id, first_name FROM tblemployeeinformations WHERE first_name LIKE '".$requestion."%')AS emp ON emp.id = req.resource_id GROUP BY req.resource_id;");
            return $resourec;
        } */
    }
}

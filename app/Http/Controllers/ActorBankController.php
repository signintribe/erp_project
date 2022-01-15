<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorModels\tblcompany_bankdetail;
use App\Models\VendorModels\tblcompanydetail;
use App\Models\erp_actor_bank;
use Auth;
use DB;
class ActorBankController extends Controller
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
            $data = $request->except(['id', 'created_at', 'updated_at', 'bank_name', 'actor_name', 'company_id']);
            erp_actor_bank::where('id', $request->id)->update($data);
        }else{
            //$chk = erp_actor_bank::where('actor_id', $request->actor_id)->where('bank_id', $request->bank_id)->first();
            //if(empty($chk)){
                $data = $request->all();
                $cid = tblcompany_bankdetail::select('com_id')->where('id', $request->bank_id)->first();
                $data['company_id'] = $cid->com_id; 
                erp_actor_bank::create($data);
            //}else{
                //return "The bank info already exist";
            //}
        }
        return "Your bank information save successfully";
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
        return erp_actor_bank::where('id', $id)->first();
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
            erp_actor_bank::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'Bank Detail Delete Permanently']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status' => false, 'message' => substr($e->errorInfo[2], 0, 68)]);
        }
    }

    public function getBankInfo($actor)
    {
        $cid = tblcompanydetail::select('id')->where('user_id', Auth::user()->id)->first();
        return DB::select("SELECT bank.bank_name, actorbank.* FROM(SELECT * FROM erp_actor_banks WHERE company_id = ".$cid->id." AND actor_name = '".$actor."') AS actorbank JOIN(SELECT id, bank_name FROM tblcompany_bankdetails) AS bank ON bank.id = actorbank.bank_id");
    }
}

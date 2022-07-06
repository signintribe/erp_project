<?php

namespace App\Http\Controllers\Tender;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tender\ErpTender;
use App\Models\Tender\ErpTenderContactPerson;
use App\Models\Tender\ErpTenderOrgContact;
use App\Models\tbladdress;
use DB;
use File;
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
        return view('tender.add-tender');
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
            $imageName = "";
            if ($request->hasFile('tender_upload')) {
                $current= date('ymd').rand(1,999999).time();
                $file= $request->file('tender_upload');
                $imageName = $current.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('tender_files'), $imageName);
                if(!empty($request->id)){
                    $this->deleteOldImage($request->tender_file);
                }
            }

            if($request->id){
                $data = $request->except(['tender_file', 'company_id', 'org', 'contact', 'address', 'tender_upload', 'id', 'created_at', 'updated_at']);
                if($imageName != ""){
                    $data['tender_file'] = $imageName;
                }
                ErpTender::where('id', $request->id)->update($data);
                $addressdata = json_decode($request->address,true);
                $orgdata = json_decode($request->org,true);
                ErpTenderOrgContact::where('tender_id', $request->id)->update($orgdata);
                $toc = ErpTenderOrgContact::select('address_id')->where('tender_id', $request->id)->first();
                if(!empty($toc)){
                    tbladdress::where('id', $toc['address_id'])->update($addressdata);
                }
                $address = tbladdress::create($addressdata);
                $contactdata = json_decode($request->contact,true);
                ErpTenderContactPerson::where('tender_id', $request->id)->update($contactdata);
            }else{
                $data = $request->except(['org', 'contact', 'address', 'tender_upload']);
                $data['tender_file'] = $imageName;
                $tender = ErpTender::create($data);
                $addressdata = json_decode($request->address,true);
                $orgdata = json_decode($request->org,true);
                $orgdata['tender_id'] = $tender->id;
                $address = tbladdress::create($addressdata);
                $orgdata['address_id'] = $address->id;
                ErpTenderOrgContact::create($orgdata);
                $contactdata = json_decode($request->contact,true);
                $contactdata['tender_id'] = $tender->id;
                ErpTenderContactPerson::create($contactdata);
            }
            return response()->json(['status' => true, 'message' => 'Tender Information Save Successfully']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status' => false, 'message' => substr($e->errorInfo[2], 0, 68)]);
        }
    }

    public function deleteOldImage($request)
    {
        if(File::exists(public_path('tender_files/'.$request))){
            $file =public_path('tender_files/'.$request);
            $img=File::delete($file);
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
            $tenders = DB::select('SELECT * FROM erp_tenders WHERE company_id= '.$data['company_id'].' LIMIT '.$data['offset'].', '.$data['limit'].';');
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
        $tenders = ErpTender::where('id', $id)->first();
        $tender_org_contact = ErpTenderOrgContact::where('tender_id', $id)->first();
        $tender_contact = ErpTenderContactPerson::where('tender_id', $id)->first();
        $tender_address = tbladdress::where('id', $tender_org_contact->address_id)->first();
        return response()->json([
            'status' => true, 
            'message' => 'All Tenders', 
            'tenders' => $tenders,
            'tender_org_contact' => $tender_org_contact,
            'tender_contact' => $tender_contact,
            'tender_address' => $tender_address,
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
        try{
            $toc = ErpTenderOrgContact::select('address_id')->where('tender_id', $id)->first();
            if(!empty($toc)){
                tbladdress::where('id', $toc['address_id'])->delete();
            }
            ErpTenderOrgContact::where('tender_id', $id)->delete();
            ErpTenderContactPerson::where('tender_id', $id)->delete();
            ErpTender::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'Tender Information Delete Permanently']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status' => false, 'message' => substr($e->errorInfo[2], 0, 68)]);
        }
    }

    public function get_tenders_for_quotations($tender_name)
    {
        return ErpTender::where('tender_no', 'LIKE', $tender_name.'%')->get();
    }
}

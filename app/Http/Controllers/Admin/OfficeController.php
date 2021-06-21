<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tbladdress;
use App\Models\tblcontact;
use App\Models\tblsocialmedias;
use App\Models\tblmaintain_office;
use App\Models\tbldepartmen;
use App\Models\VendorModels\tblcompanydetail;
use DB;
use Auth;
class OfficeController extends Controller
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
        return DB::select('call sp_getAlloffices('.Auth::user()->id.')');
    }

    public function maintain_office(){
        return view('admin.maintain-office');
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
            $this->update($request);
        }else{
            $addressdata = $request->except(['office_name', 'office_type', 'start_date', 'office_status', 'scope_office', 'phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'email', 'website', 'twitter', 'instagram', 'facebook', 'linkedin', 'pinterest']);
            $adderss = tbladdress::create($addressdata);
            $adderss_id = $adderss->id;
            $contactdata = $request->except(['address_line_1', 'address_line_2', 'city', 'country', 'postal_code', 'sector', 'state', 'street', 'zip_code', 'office_name', 'office_type', 'start_date', 'office_status', 'scope_office', 'website', 'twitter', 'instagram', 'facebook', 'linkedin', 'pinterest']);
            $contact = tblcontact::create($contactdata);
            $contact_id = $contact->id;
            $smdata = $request->except(['address_line_1', 'address_line_2', 'city', 'country', 'postal_code', 'sector', 'state', 'street', 'zip_code', 'office_name', 'office_type', 'start_date', 'office_status', 'scope_office', 'phone_number', 'mobile_number', 'fax_number']);
            $sm = tblsocialmedias::create($smdata);
            $sm_id = $sm->id;
            $officedata = $request->except(['address_line_1', 'address_line_2', 'city', 'country', 'postal_code', 'sector', 'state', 'street', 'zip_code', 'phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'email', 'website', 'twitter', 'instagram', 'facebook', 'linkedin', 'pinterest']);
            $officedata['office_status'] = $request->office_status == 'true' ? 1 : 0;
            $officedata['address_id'] = $adderss_id;
            $officedata['contact_id'] = $contact_id;
            $officedata['social_id'] = $sm_id;
            $company = tblcompanydetail::where('user_id', Auth::user()->id)->first();
            $officedata['company_id'] = $company->id;
            $office = tblmaintain_office::create($officedata);
        }
        return 'Company Office Save Successfully';
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
        return tblmaintain_office::where('id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($request)
    {
        $addressdata = $request->except(['address_id', 'contact_id', 'social_id', 'company_id', 'id', 'created_at', 'updated_at', 'office_name', 'office_type', 'start_date', 'office_status', 'scope_office', 'phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'email', 'website', 'twitter', 'instagram', 'facebook', 'linkedin', 'pinterest']);
        $adderss = tbladdress::where('id', $request->address_id)->update($addressdata);
        $contactdata = $request->except(['address_id', 'contact_id', 'social_id', 'company_id', 'id', 'created_at', 'updated_at', 'address_line_1', 'address_line_2', 'address_line_3', 'city', 'country', 'postal_code', 'sector', 'state', 'street', 'zip_code', 'office_name', 'office_type', 'start_date', 'office_status', 'scope_office', 'website', 'twitter', 'instagram', 'facebook', 'linkedin', 'pinterest']);
        $contact = tblcontact::where('id', $request->contact_id)->update($contactdata);
        $smdata = $request->except(['address_id', 'contact_id', 'social_id', 'company_id', 'id', 'created_at', 'updated_at', 'address_line_1', 'address_line_2', 'address_line_3', 'city', 'country', 'postal_code', 'sector', 'state', 'street', 'zip_code', 'office_name', 'office_type', 'start_date', 'office_status', 'scope_office', 'phone_number', 'mobile_number', 'fax_number']);
        $sm = tblsocialmedias::where('id', $request->social_id)->create($smdata);
        $officedata = $request->except(['address_id', 'contact_id', 'social_id', 'company_id', 'id', 'created_at', 'updated_at', 'address_line_1', 'address_line_2', 'address_line_3', 'city', 'country', 'postal_code', 'sector', 'state', 'street', 'zip_code', 'phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'email', 'website', 'twitter', 'instagram', 'facebook', 'linkedin', 'pinterest']);
        $officedata['office_status'] = $request->office_status == 'true' ? 1 : 0;
        $office = tblmaintain_office::where('id', $request->id)->update($officedata);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $info = tblmaintain_office::where('id', $id)->first();
            tbldepartmen::where('office_id', $id)->delete();
            tbladdress::where('id', $info->address_id)->delete();
            tblcontact::where('id', $info->contact_id)->delete();
            tblsocialmedias::where('id', $info->social_id)->delete();
            tblmaintain_office::where('id', $id)->delete();
            return "Office information delete";
          } catch (\Illuminate\Database\QueryException $e) {
              return $e->errorInfo[2];
          }
    }

    public function getoffice($company_id){
        if($company_id == 0){
            $com = $company_id = \App\Models\VendorModels\tblcompanydetail::select('id')->where('user_id', Auth::user()->id)->first();
            $company_id = $com->id;
        }
        return tblmaintain_office::where('company_id', $company_id)->get();
    }
}

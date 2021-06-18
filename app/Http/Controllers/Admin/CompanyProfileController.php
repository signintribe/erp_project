<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tbladdress;
use App\Models\tblsocialmedias;
use App\Models\tblcontact;
use App\Models\tblcompany_registration;
use App\Models\tblmaintain_office;
use App\Models\VendorModels\tblcompanydetail;
use Auth;

class CompanyProfileController extends Controller
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
        return $request->all();
        $addressdata = $request->except(['facebook', 'linkedin', 'twitter', 'website', 'youtube', 'companyLogo', 'user_id', 'company_name', 'phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'email', 'office_timing', 'established', 'address', 'desription', 'company_logo']);
        $address = tbladdress::create($addressdata);
    
        $socialmediadata = $request->except(['address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code', 'companyLogo', 'user_id', 'company_name', 'phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'email', 'office_timing', 'established', 'address', 'desription', 'company_logo']);
        $social = tblsocialmedias::create($socialmediadata);
        
        $contactdata = $request->except(['address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code', 'companyLogo', 'user_id', 'company_name', 'office_timing', 'established', 'address', 'desription', 'company_logo']);
        $contact = tblcontact::create($contactdata);

        $companydata = $request->except(['phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'email','facebook', 'linkedin', 'twitter', 'website', 'youtube', 'address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code']);
        $companydata['address_id'] = $address->id;
        $companydata['social_id'] = $social->id;
        $companydata['contact_id'] = $contact->id;
        $companydata['user_id'] = Auth::user()->id;

        if ($request->hasFile('companyLogo')) {
            $current = date('ymd') . rand(1, 999999) . time();
            $file = $request->file('companyLogo');
            $imgname = $current . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/company_logs'), $imgname);
        }
        $companydata['company_logo'] = $imgname;    
        tblcompanydetail::create($companydata);

        return "Your comapny information save successfully";
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
        return tblcompanydetail::where('user_id', $id)->first();
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
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chkreg = tblcompany_registration::where('company_id', $id)->first();
        $chkoffice = tblmaintain_office::where('company_id', $id)->first();
        if(empty($chkoffice) && empty($chkreg)){
            $company = tblcompanydetail::where('id', $id)->first();
            tbladdress::where('id', $company->address_id)->delete();
            tblcontact::where('id', $company->contact_id)->delete();
            tblsocialmedias::where('id', $company->social_id)->delete();
            tblcompanydetail::where('id', $id)->delete();
            
            return array(
                "status" => 0,
                "message" => "Company Record Delete Permanently"
            );
        }else{
            return array(
                "status" => 1, 
                "message" => "You can not delete company before deleting office or company registration"
            );
        }
    }
}

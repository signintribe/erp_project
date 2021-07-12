<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tblsocialmedias;
use App\Models\tblcontact;
use App\Models\VendorModels\tblcompanydetail;
use App\Models\VendorModels\tblcompany_contact;
use Auth;
use DB;

class CompanyContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('SELECT company.*, cominfo.company_name, contact.phone_number, contact.mobile_number, contact.fax_number, contact.whatsapp, contact.email,  social.website, social.twitter, social.instagram, social.facebook, social.linkedin, social.pinterest FROM (SELECT * FROM tblcompany_contacts) AS company JOIN (SELECT id, company_name FROM tblcompanydetails) AS cominfo ON cominfo.id = company.com_id JOIN (SELECT id, phone_number,mobile_number,fax_number,whatsapp,email FROM tblcontacts) AS contact on contact.id = company.contact_id JOIN (SELECT id , website, twitter, instagram, facebook, linkedin, pinterest FROM tblsocialmedias) AS social ON social.id = company.social_id');
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
        //return $request->all();
        $company = tblcompanydetail::where('user_id', Auth::user()->id)->first();
        if($request->id){
            $contact = $request->except('id','contact_id','com_id','company_name','youtube','social_id','website','twitter','instagram','facebook','linkedin','pinterest','created_at','updated_at');
            $social = $request->except('id','phone_number','contact_id','com_id','company_name','social_id','mobile_number','fax_number','whatsapp','email','created_at','updated_at');
            $comcontact = $request->except('id','contact_id','social_id','website','company_name','twitter','youtube','instagram','facebook','linkedin','pinterest','mobile_number','phone_number','fax_number','whatsapp','email','created_at','updated_at');
            tblcontact::where('id', $request->contact_id)->update($contact);
            tblsocialmedias::where('id', $request->social_id)->update($social);
            tblcompany_contact::where('id', $request->id)->update($comcontact);
            return 'Update';
        }else{
            $contact = $request->except('website','twitter','instagram','facebook','linkedin','pinterest','youtube');
            $social = $request->except('phone_number','mobile_number','fax_number','whatsapp','email');
            $contacts = tblcontact::create($contact);
            $socials = tblsocialmedias::create($social);
            $comcontact['com_id'] = $company->id;
            $comcontact['contact_id'] = $contacts->id;
            $comcontact['social_id'] = $socials->id;
            tblcompany_contact::create($comcontact);
        }
        return 'Save';
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
        return DB::select('SELECT company.*, cominfo.company_name, contact.phone_number, contact.mobile_number, contact.fax_number, contact.whatsapp, contact.email,  social.website, social.twitter, social.instagram, social.facebook, social.linkedin, social.pinterest FROM (SELECT * FROM tblcompany_contacts where id = '.$id.') AS company JOIN (SELECT id, company_name FROM tblcompanydetails) AS cominfo ON cominfo.id = company.com_id JOIN (SELECT id, phone_number,mobile_number,fax_number,whatsapp,email FROM tblcontacts) AS contact on contact.id = company.contact_id JOIN (SELECT id , website, twitter, instagram, facebook, linkedin, pinterest FROM tblsocialmedias) AS social ON social.id = company.social_id');

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
        $data = tblcompany_contact::where('id', $id)->first();
        tblcompany_contact::where('id', $data->id)->delete();
        tblcontact::where('id', $data->contact_id)->delete();
        tblsocialmedias::where('id', $data->social_id)->delete();
        return 'Deleted';
    }
}

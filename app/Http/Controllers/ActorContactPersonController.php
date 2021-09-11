<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\erp_contact_people;
use App\Models\tblcontact;
use App\Models\tbladdress;
use App\Models\tblsocialmedias;
use DB;
use File;
class ActorContactPersonController extends Controller
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
        
        //if(empty(erp_contact_people::where('actor_id', $request->actor_id)->first())){
            $imageName = "";
            if ($request->hasFile('userpicture')) {
                $current= date('ymd').rand(1,999999).time();
                $file= $request->file('userpicture');
                $imageName = $current.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('contactperson_picture'), $imageName);
                if(!empty($request->id)){
                    $this->deleteOldImage($request->picture);
                }
            }
            if($request->id){
                $social = $request->except('id', 'company_id', 'userpicture', 'actor_id', 'actor_name', 'contact_id','social_id','address_id','title','first_name','last_name','picture','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','created_at','updated_at');
                $contact = $request->except('id', 'company_id', 'userpicture', 'actor_id', 'actor_name', 'contact_id','social_id','address_id','title','first_name','last_name','picture','website','twitter','instagram','facebook','linkedin','pinterest','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','created_at','updated_at');
                $address = $request->except('id', 'company_id', 'userpicture', 'actor_id', 'actor_name', 'contact_id','social_id','address_id','title','first_name','last_name','picture','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','created_at','updated_at');
                $contactperson = $request->except('id','userpicture', 'website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','created_at','updated_at');
                tblsocialmedias::where('id', $request->social_id)->update($social);
                tblcontact::where('id', $request->contact_id)->update($contact);
                tbladdress::where('id', $request->address_id)->update($address);
                if($imageName != ""){
                    $contactperson['picture'] = $imageName;
                }
                erp_contact_people::where('id', $request->id)->update($contactperson);
            }else{
                $social = $request->except('actor_id', 'actor_name', 'userpicture','contact_id','social_id','address_id','title','first_name','last_name','picture','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code',);
                $contact = $request->except('actor_id', 'actor_name', 'userpicture','contact_id','social_id','address_id','title','first_name','last_name','picture','website','twitter','instagram','facebook','linkedin','pinterest','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code',);
                $address = $request->except('actor_id', 'actor_name', 'userpicture','contact_id','social_id','address_id','title','first_name','last_name','picture','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email');
                $contactperson = $request->except('website','userpicture','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code');
                $social = tblsocialmedias::create($social);
                $contact = tblcontact::create($contact);
                $address = tbladdress::create($address);
                $contactperson['social_id'] = $social->id;
                $contactperson['contact_id'] = $contact->id;
                $contactperson['address_id'] = $address->id;
                $contactperson['picture'] = $imageName;
                $contactperson = erp_contact_people::create($contactperson);
            }
            return "Contact Person Save Successfully";
        /* }else{
            return 'Contact Person Already Exists';
        } */
    }

    public function deleteOldImage($request)
    {
        if(File::exists(public_path('contactperson_picture/'.$request))){
            $file =public_path('contactperson_picture/'.$request);
            $img=File::delete($file);
        }
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
        return erp_contact_people::where('id', $id)->first();
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
        $contact = erp_contact_people::where('id', $id)->first();
        erp_contact_people::where('id', $id)->delete();
        tblsocialmedias::where('id', $contact->social_id)->delete();
        tblcontact::where('id', $contact->contact_id)->delete();
        tbladdress::where('id', $contact->address_id)->delete();
        return "Your Contact Person Delete";
    }

    public function getCompanyInfo($actor_name, $company_id)
    {
        return DB::select('SELECT people.*, contact.email, contact.mobile_number, contact.phone_number, contact.whatsapp FROM (SELECT * FROM erp_contact_peoples WHERE actor_name = "'.$actor_name.'" AND company_id='.$company_id.') AS people JOIN(SELECT id, email, mobile_number, phone_number, whatsapp FROM tblcontacts)AS contact ON contact.id = people.contact_id');
    }
}

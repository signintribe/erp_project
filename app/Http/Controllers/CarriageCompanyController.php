<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\erp_carriage_company;
use App\Models\tbladdress;
use App\Models\tblcontact;
use App\Models\tblsocialmedias;
use Auth;
use DB;
use File;

class CarriageCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('SELECT carriage.*, address.city, address.country, contact.mobile_number FROM (SELECT * FROM erp_carriage_companies) AS carriage JOIN (SELECT id, city, country FROM tbladdresses) AS address on address.id = carriage.address_id JOIN (SELECT id, mobile_number FROM tblcontacts) AS contact on contact.id = carriage.contact_id');
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
        $imageName = "";
        if ($request->hasFile('logo_file')) {
            $current= date('ymd').rand(1,999999).time();
            $file= $request->file('logo_file');
            $imageName = $current.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('organization_logo'), $imageName);
            if($request->id){
                $this->deleteOldImage($request->organization_logo);
            }
        }
        if($request->id){
            $carriage = $request->except('id', 'logo_file', 'address_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','street','sector','city','state','country','postal_code','zip_code','created_at','updated_at');
            $address = $request->except('id', 'logo_file', 'address_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','user_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing','created_at','updated_at');
            $contact = $request->except('id', 'logo_file', 'website','twitter','instagram','facebook','linkedin','pinterest','address_id','contact_id','social_id','address_line_1','address_line_2', 'street','sector','city','state','country','postal_code','zip_code','user_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing','created_at','updated_at');
            $social = $request->except('id', 'address_line_1', 'logo_file', 'address_line_2','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','user_id','address_id','contact_id','social_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing');
            if($imageName){
                $carriage['organization_logo'] = $imageName;
            }            
            erp_carriage_company::where('id', $request->id)->update($carriage);
            tbladdress::where('id', $request->address_id)->update($address);
            tblcontact::where('id', $request->contact_id)->update($contact);
            tblsocialmedias::where('id', $request->social_id)->update($social);            
            return "Carriage Company Update successfully";
        }else{
            $carriage = $request->except('website','twitter','logo_file','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','street','sector','city','state','country','postal_code','zip_code');
            $address = $request->except('address_id','contact_id','logo_file','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','user_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing');
            $contact = $request->except('address_id','website','twitter','logo_file','instagram','facebook','linkedin','pinterest','contact_id','social_id','address_line_1','address_line_2','street','sector','city','state','country','postal_code','zip_code','user_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing');
            $social = $request->except('address_line_1','address_line_2','logo_file','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','user_id','address_id','contact_id','social_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing');
            $address = tbladdress::create($address);
            $contact = tblcontact::create($contact);
            $social = tblsocialmedias::create($social);

            $carriage['user_id'] = Auth::user()->id;
            $carriage['address_id'] = $address->id;
            $carriage['contact_id'] = $contact->id;
            $carriage['social_id'] = $social->id;
            $carriage['organization_logo'] = $imageName;
            erp_carriage_company::create($carriage);
        }
        return "Carriage Company save successfully";
    }

    public function deleteOldImage($request)
    {
        if(File::exists(public_path('organization_logo/'.$request))){
            $file = public_path('organization_logo/'.$request);
            $img=File::delete($file);
        }
    }

    public function editCusClearance($id){
        return view('logistic.edit-carriage-company', compact('id'));
    }

    public function getCusClearanceInfo($id){
        return DB::select('SELECT id, address_id, contact_id, social_id, organization_name, ntn_no, incroporation_no, organization_logo, strn, import_license, export_license, chamber_no, currency_dealing  FROM erp_carriage_companies where id = '.$id.' ');
    }

    public function getAddress($address_id){
        return DB::select('SELECT address_line_1,address_line_2,street,sector,city,state,country  FROM tbladdresses  where id = '.$address_id.' ');

    }

    public function getContact($contact_id){
        return DB::select('SELECT phone_number,mobile_number,fax_number,whatsapp,email FROM tblcontacts  where id = '.$contact_id.' ');

    }

    public function getsocial($social_id){
        return DB::select('SELECT website,twitter,instagram,facebook,linkedin,pinterest FROM tblsocialmedias  where id = '.$social_id.' ');
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
        $det = erp_carriage_company::where('id', $id)->first();
        erp_carriage_company::where('id', $id)->delete();
        tbladdress::where('id', $det->address_id)->delete();
        tblcontact::where('id', $det->contact_id)->delete();
        tblsocialmedias::where('id', $det->social_id)->delete();
        return 'Carriage Company Info Delete Permanently';
    }
}

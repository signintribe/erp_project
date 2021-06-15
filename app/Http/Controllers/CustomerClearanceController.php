<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\erp_customer_clearance;
use App\Models\tbladdress;
use App\Models\tblcontact;
use App\Models\tblsocialmedias;
use Auth;
use DB;
use File;

class CustomerClearanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('SELECT clearance.*, address.city, address.country, contact.mobile_number FROM (SELECT * FROM erp_customer_clearances) AS clearance JOIN (SELECT id, city, country FROM tbladdresses) AS address on address.id = clearance.address_id JOIN (SELECT id, mobile_number FROM tblcontacts) AS contact on contact.id = clearance.contact_id');
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
            $clearance = $request->except('id', 'logo_file', 'address_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','street','sector','city','state','country','postal_code','zip_code','created_at','updated_at');
            $address = $request->except('id', 'logo_file', 'address_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','user_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing','created_at','updated_at');
            $contact = $request->except('id', 'logo_file', 'website','twitter','instagram','facebook','linkedin','pinterest','address_id','contact_id','social_id','address_line_1','address_line_2', 'street','sector','city','state','country','postal_code','zip_code','user_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing','created_at','updated_at');
            $social = $request->except('id', 'address_line_1', 'logo_file', 'address_line_2','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','user_id','address_id','contact_id','social_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing');
            if($imageName){
                $clearance['organization_logo'] = $imageName;
            }            
            erp_customer_clearance::where('id', $request->id)->update($clearance);
            tbladdress::where('id', $request->address_id)->update($address);
            tblcontact::where('id', $request->contact_id)->update($contact);
            tblsocialmedias::where('id', $request->social_id)->update($social);            
            return "Customer Clearance Update successfully";
        }else{
            $clearance = $request->except('website','twitter','logo_file','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','street','sector','city','state','country','postal_code','zip_code');
            $address = $request->except('address_id','contact_id','logo_file','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','user_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing');
            $contact = $request->except('address_id','website','twitter','logo_file','instagram','facebook','linkedin','pinterest','contact_id','social_id','address_line_1','address_line_2','street','sector','city','state','country','postal_code','zip_code','user_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing');
            $social = $request->except('address_line_1','address_line_2','logo_file','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','user_id','address_id','contact_id','social_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing');
            $address = tbladdress::create($address);
            $contact = tblcontact::create($contact);
            $social = tblsocialmedias::create($social);

            $clearance['user_id'] = Auth::user()->id;
            $clearance['address_id'] = $address->id;
            $clearance['contact_id'] = $contact->id;
            $clearance['social_id'] = $social->id;
            $clearance['organization_logo'] = $imageName;
            erp_customer_clearance::create($clearance);
        }
        return "Customer Clearance save successfully";
    }

    public function deleteOldImage($request)
    {
        if(File::exists(public_path('organization_logo/'.$request))){
            $file = public_path('organization_logo/'.$request);
            $img=File::delete($file);
        }
    }

    public function editCusClearance($id){
        return view('logistic.edit-customer-clearance', compact('id'));
    }

    public function getCusClearanceInfo($id){
        return DB::select('SELECT id, address_id, contact_id, social_id, organization_name, ntn_no, incroporation_no, organization_logo, strn, import_license, export_license, chamber_no, currency_dealing  FROM erp_customer_clearances where id = '.$id.' ');
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
        $det = erp_customer_clearance::where('id', $id)->first();
        erp_customer_clearance::where('id', $id)->delete();
        tbladdress::where('id', $det->address_id)->delete();
        tblcontact::where('id', $det->contact_id)->delete();
        tblsocialmedias::where('id', $det->social_id)->delete();
        return 'Customer Clearance Info Delete Permanently';
    }
}

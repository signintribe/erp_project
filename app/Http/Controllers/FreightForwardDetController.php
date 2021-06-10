<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\erp_freightforward_det;
use App\Models\tbladdress;
use App\Models\tblcontact;
use App\Models\tblsocialmedias;
use Auth;
use DB;
use File;

class FreightForwardDetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('SELECT freight.*, address.city, address.id,address.country, contact.mobile_number FROM (SELECT * FROM erp_freightforward_dets) AS freight JOIN (SELECT id, city, country FROM tbladdresses) AS address on address.id = freight.address_id JOIN (SELECT id, mobile_number FROM tblcontacts) AS contact on contact.id = freight.contact_id');
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
        $imageName = "";
        if ($request->hasFile('organization_logo')) {
            $current= date('ymd').rand(1,999999).time();
            $file= $request->file('organization_logo');
            $imageName = $current.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('organization_logo'), $imageName);
            if(!empty($request->id)){
                $this->deleteOldImage($request->organization_logo);
                $freight = erp_freightforward_det::where('id', $request->id)->first();
                $freight->organization_logo = $imageName;
                $freight->save();
            }
        }

        if($request->id){
            $freight = $request->except('id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','created_at','updated_at');
            $address = $request->except('id','address_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','user_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing','created_at','updated_at');
            $contact = $request->except('id','address_id','contact_id','social_id','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','user_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing','created_at','updated_at');
            $social = $request->except('address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','user_id','address_id','contact_id','social_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing');
            
            tbladdress::where('address_id', $request->id)->update($address);
            tblcontact::where('contact_id', $request->id)->update($contact);
            tblsocialmedias::where('social_id', $request->id)->update($social);
            if ($imageName){
                $freight['organization_logo'] = $imageName; 
            }
            erp_freightforward_det::where('id', $request->id)->update($freight);
            return "Purchase Order Update successfully";
        }else{
            $freight = $request->except('website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code');
            $address = $request->except('address_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','user_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing');
            $contact = $request->except('address_id','contact_id','social_id','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','user_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing');
            $social = $request->except('address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','user_id','address_id','contact_id','social_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing');
            $address = tbladdress::create($address);
            $contact = tblcontact::create($contact);
            $social = tblsocialmedias::create($social);

            $freight['user_id'] = Auth::user()->id;
            $freight['address_id'] = $address->id;
            $freight['contact_id'] = $contact->id;
            $freight['social_id'] = $social->id;
            erp_freightforward_det::create($freight);
        }
        return "Freight Forward Det save successfully";
    }

    public function deleteOldImage($request)
    {
        if(File::exists(public_path('organization_logo/'.$request))){
            $file =public_path('organization_logo/'.$request);
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
        //
    }
}

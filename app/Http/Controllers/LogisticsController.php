<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\erp_logistic;
use App\Models\tbladdress;
use App\Models\tblcontact;
use App\Models\tblsocialmedias;
use Auth;
use DB;
use File;

/**
 * Description of LogisticsController
 *
 * @author Attique
 */
class LogisticsController extends Controller {

    public function __construct() {
        return $this->middleware('auth');
    }

    public function getLogistics()
    {
        return DB::select('SELECT logistic.*, address.city, address.country, contact.mobile_number FROM (SELECT * FROM erp_logistics) AS logistic JOIN (SELECT id, city, country FROM tbladdresses) AS address on address.id = logistic.address_id JOIN (SELECT id, mobile_number FROM tblcontacts) AS contact on contact.id = logistic.contact_id');
    }

    public function index(){
        return view('logistic.add-logistic');
    }

    public function viewLogistics(){
        return view('logistic.view-logistic');
    }

    public function saveLogistic(Request $request){
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
            $logistic = $request->except('id', 'logo_file', 'address_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','street','sector','city','state','country','postal_code','zip_code','created_at','updated_at');
            $address = $request->except('id', 'logistic_type','logo_file', 'address_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','user_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing','created_at','updated_at');
            $contact = $request->except('id', 'logistic_type','logo_file', 'website','twitter','instagram','facebook','linkedin','pinterest','address_id','contact_id','social_id','address_line_1','address_line_2', 'street','sector','city','state','country','postal_code','zip_code','user_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing','created_at','updated_at');
            $social = $request->except('id', 'logistic_type','address_line_1', 'logo_file', 'address_line_2','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','user_id','address_id','contact_id','social_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing','created_at','updated_at');
            if($imageName){
                $logistic['organization_logo'] = $imageName;
            }            
            erp_logistic::where('id', $request->id)->update($logistic);
            tbladdress::where('id', $request->address_id)->update($address);
            tblcontact::where('id', $request->contact_id)->update($contact);
            tblsocialmedias::where('id', $request->social_id)->update($social);            
            return "Logistic Info Update successfully";
        }else{
            $logistic = $request->except('website','twitter','logo_file','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','street','sector','city','state','country','postal_code','zip_code');
            $address = $request->except('address_id','logistic_type','contact_id','logo_file','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','user_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing');
            $contact = $request->except('address_id','logistic_type','website','twitter','logo_file','instagram','facebook','linkedin','pinterest','contact_id','social_id','address_line_1','address_line_2','street','sector','city','state','country','postal_code','zip_code','user_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing');
            $social = $request->except('address_line_1','logistic_type','address_line_2','logo_file','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','user_id','address_id','contact_id','social_id','organization_name','ntn_no','incroporation_no','organization_logo','strn','import_license','export_license','chamber_no','currency_dealing');
            $address = tbladdress::create($address);
            $contact = tblcontact::create($contact);
            $social = tblsocialmedias::create($social);

            $logistic['user_id'] = Auth::user()->id;
            $logistic['address_id'] = $address->id;
            $logistic['contact_id'] = $contact->id;
            $logistic['social_id'] = $social->id;
            $logistic['organization_logo'] = $imageName;
            erp_logistic::create($logistic);
        }
        return "Logistic Info save successfully";
    }

    public function deleteOldImage($request)
    {
        if(File::exists(public_path('organization_logo/'.$request))){
            $file = public_path('organization_logo/'.$request);
            $img=File::delete($file);
        }
    }

    public function viewEdit($id){
        return view('logistic.edit-logistic', compact('id'));
    }

    public function editLogistic($id){
        return DB::select('SELECT id, address_id, logistic_type, contact_id, social_id, organization_name, ntn_no, incroporation_no, organization_logo, strn, import_license, export_license, chamber_no, currency_dealing  FROM erp_logistics  where id = '.$id.' ');
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

    public function destroy($id)
    {
        $det = erp_logistic::where('id', $id)->first();
        erp_logistic::where('id', $id)->delete();
        tbladdress::where('id', $det->address_id)->delete();
        tblcontact::where('id', $det->contact_id)->delete();
        tblsocialmedias::where('id', $det->social_id)->delete();
        return 'Logistic Info Delete Permanently';
    }
    /* public function index() {
        return view('logistic.freight-forward-det');
    }

    public function customer_clearance() {
        return view('logistic.customer-clearance');
    }

    public function carriage_company() {
        return view('logistic.carriage-company');
    }

    public function view_freight_forward_det() {
        return view('logistic.view-freight-forward-det');
    }

    public function view_customer_clearance() {
        return view('logistic.view-customer-clearance');
    }

    public function view_carriage_company() {
        return view('logistic.view-carriage-company');
    } */

    public function sourcingBankDetail()
    {
        return view('logistic.sourcing-bank-detail');
    }

}

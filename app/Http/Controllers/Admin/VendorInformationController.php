<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use File;
use App\Models\VendorModels\erp_vendor_information;
use App\Models\tbladdress;
use App\Models\tblcontact;
use App\Models\tblsocialmedias;
class VendorInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return erp_vendor_information::where('user_id', Auth::user()->id)->get();
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
        if ($request->hasFile('org_logo')) {
            $current= date('ymd').rand(1,999999).time();
            $file= $request->file('org_logo');
            $imageName = $current.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('organization_logo'), $imageName);
            if(!empty($request->id)){
                $this->deleteOldImage($request->organization_logo);
            }
        }

        if($request->id){
            $data = $request->except('id', 'company_id',  'address_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2', 'address_line_3', 'street','sector','city','state','country','postal_code','zip_code', 'org_logo', 'created_at','updated_at');
            $address = $request->except('id', 'organization_logo', 'company_id', 'vendor_type', 'address_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','user_id','organization_name' ,'org_logo','currency_dealing','created_at','updated_at');
            $contact = $request->except('id', 'organization_logo', 'company_id', 'vendor_type', 'website','twitter','instagram','facebook','linkedin','pinterest','address_id','contact_id','social_id','address_line_1','address_line_2', 'address_line_3','street','sector','city','state','country','postal_code','zip_code','user_id','organization_name', 'org_logo','currency_dealing','created_at','updated_at');
            $social = $request->except('id', 'organization_logo', 'company_id', 'vendor_type','address_line_1', 'address_line_2', 'address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','user_id','address_id','contact_id','social_id','organization_name', 'org_logo', 'currency_dealing','created_at','updated_at');
            if ($imageName !=""){
                $data['organization_logo'] = $imageName; 
            }

            erp_vendor_information::where('id', $request->id)->update($data);
            tbladdress::where('id', $request->address_id)->update($address);
            tblcontact::where('id', $request->contact_id)->update($contact);
            tblsocialmedias::where('id', $request->social_id)->update($social);
        }else{
            if(empty(erp_vendor_information::where('organization_name', $request->organization_name)->first())){
                $data = $request->except('website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code', 'org_logo');
                $address = $request->except('company_id', 'address_id','vendor_type','contact_id','logo_file','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','user_id','organization_name','org_logo','currency_dealing');
                $contact = $request->except('company_id', 'address_id','vendor_type','website','twitter','logo_file','instagram','facebook','linkedin','pinterest','contact_id','social_id','address_line_1','address_line_2', 'address_line_3','street','sector','city','state','country','postal_code','zip_code','user_id','organization_name','org_logo','currency_dealing');
                $social = $request->except('company_id', 'address_line_1','vendor_type','address_line_2', 'address_line_3','logo_file','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','user_id','address_id','contact_id','social_id','organization_name','org_logo','currency_dealing');
                
                $address = tbladdress::create($address);
                $contact = tblcontact::create($contact);
                $social = tblsocialmedias::create($social);

                $data['user_id'] = Auth::user()->id;
                $data['address_id'] = $address->id;
                $data['contact_id'] = $contact->id;
                $data['social_id'] = $social->id;
                $data['organization_logo'] = $imageName;
                $data['user_id'] = Auth::user()->id;

                erp_vendor_information::create($data);
            }else{
                return 'Vendor Already Exist';
            }
        }
        return "Vendor Information saved successfully";

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
        $vendorinfo = DB::select('SELECT vendorinfo.*, contacts.phone_number, contacts.email FROM (SELECT * FROM erp_vendor_informations WHERE company_id = '.$id.')AS vendorinfo JOIN (SELECT id, phone_number,email FROM tblcontacts) AS contacts ON contacts.id = vendorinfo.contact_id');
        return response()->json([
            'status' => true,
            'data' => $vendorinfo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return erp_vendor_information::where('id', $id)->first();
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
            $det = erp_vendor_information::where('id', $id)->first();
            tbladdress::where('id', $det->address_id)->delete();
            tblcontact::where('id', $det->contact_id)->delete();
            tblsocialmedias::where('id', $det->social_id)->delete();
            erp_vendor_information::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'Logistic Delete Permanently']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status' => false, 'message' => substr($e->errorInfo[2], 0, 68)]);
        }
    }

    public function getVendors($ven_id){
        return DB::select('call sp_getvendorinfo('.Auth::user()->id.','.$ven_id.')');
    }

    public function vendorBankDetail()
    {
        return view('vendor_center.vendor-bank-detail');
    }
}

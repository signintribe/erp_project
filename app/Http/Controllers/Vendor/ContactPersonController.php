<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tblcontact;
use App\Models\tbladdress;
use App\Models\tblsocialmedias;
use App\Models\VendorModels\erp_vendor_contactpersons;
use App\Models\VendorModels\erp_vendor_information;
use DB;
Use File;
use Auth;

class ContactPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('call sp_getVendorContactPerson('.Auth::user()->id.')');
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
        if ($request->hasFile('userpicture')) {
            $current= date('ymd').rand(1,999999).time();
            $file= $request->file('userpicture');
            $imageName = $current.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('contactperson_picture'), $imageName);
            if(!empty($request->id)){
                $this->deleteOldImage($request->picture);
                /* $tasks = erp_vendor_contactpersons::where('id', $request->id)->first();
                $tasks->picture = $imageName;
                $tasks->save(); */
            }
        }

        if($request->id){
            $social = $request->except('id', 'userpicture', 'vendor_id','contact_id','social_id','address_id','title','first_name','last_name','picture','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','created_at','updated_at');
            $contact = $request->except('id','userpicture', 'vendor_id','contact_id','social_id','address_id','title','first_name','last_name','picture','website','twitter','instagram','facebook','linkedin','pinterest','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','created_at','updated_at');
            $address = $request->except('id','userpicture', 'vendor_id','contact_id','social_id','address_id','title','first_name','last_name','picture','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','created_at','updated_at');
            $contactperson = $request->except('id','userpicture', 'website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','created_at','updated_at');
            tblsocialmedias::where('id', $request->social_id)->update($social);
            tblcontact::where('id', $request->contact_id)->update($contact);
            tbladdress::where('id', $request->address_id)->update($address);
            if($imageName != ""){
                $contactperson['picture'] = $imageName;
            }
            erp_vendor_contactpersons::where('id', $request->id)->update($contactperson);
        }
        else{
            $social = $request->except('vendor_id','userpicture','contact_id','social_id','address_id','title','first_name','last_name','picture','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code',);
            $contact = $request->except('vendor_id','userpicture','contact_id','social_id','address_id','title','first_name','last_name','picture','website','twitter','instagram','facebook','linkedin','pinterest','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code',);
            $address = $request->except('vendor_id','userpicture','contact_id','social_id','address_id','title','first_name','last_name','picture','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email');
            $contactperson = $request->except('website','userpicture','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code');
            $social = tblsocialmedias::create($social);
            $contact = tblcontact::create($contact);
            $address = tbladdress::create($address);
            $contactperson['social_id'] = $social->id;
            $contactperson['contact_id'] = $contact->id;
            $contactperson['address_id'] = $address->id;
            $contactperson['picture'] = $imageName;
            $contactperson = erp_vendor_contactpersons::create($contactperson);
        }
        

        return "Contact Person Save Successfully";
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
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
        return erp_vendor_contactpersons::where('id', $id)->first();
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
        $det = erp_vendor_contactpersons::where('id', $id)->first();
        erp_vendor_contactpersons::where('id', $id)->delete();
        tblcontact::where('id', $det->contact_id)->delete();
        tblsocialmedias::where('id', $det->social_id)->delete();
        tbladdress::where('id', $det->address_id)->delete();
        return 'Vendor contact Delete Permanently';
    }
}

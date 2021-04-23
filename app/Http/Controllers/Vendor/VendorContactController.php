<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorModels\erp_vendor_contacts;
use App\Models\tblcontact;
use App\Models\tblsocialmedias;
use Auth;
use DB;

class VendorContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('call sp_getVendorContact('.Auth::user()->id.')');
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
            $contact = $request->except('id','vendor_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest','created_at','updated_at');
            $vendor = $request->except('id','phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest','created_at','updated_at');
            $social = $request->except('id','vendor_id','contact_id','social_id','phone_number','mobile_number','fax_number','whatsapp','email','created_at','updated_at');
            tblcontact::where('id', $request->contact_id)->update($contact);
            tblsocialmedias::where('id', $request->social_id)->update($social);
            erp_vendor_contacts::where('id', $request->id)->update($vendor);
        }
        else{
            $contact = $request->except('vendor_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest');
            $vendor = $request->except('phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest');
            $social = $request->except('vendor_id','contact_id','social_id','phone_number','mobile_number','fax_number','whatsapp','email');
            $contact = tblcontact::create($contact);
            $social = tblsocialmedias::create($social);
            $vendor['contact_id'] = $contact->id;
            $vendor['social_id'] = $social->id;
            $vendor = erp_vendor_contacts::create($vendor);
        }
        
        return "Vendor Contact Save Successfully";
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
        return erp_vendor_contacts::where('id', $id)->first();
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
        $det = erp_vendor_contacts::where('id', $id)->first();
        erp_vendor_contacts::where('id', $id)->delete();
        tblcontact::where('id', $det->contact_id)->delete();
        tblsocialmedias::where('id', $det->social_id)->delete();
        return 'Vendor contact Delete Permanently';
    }
}

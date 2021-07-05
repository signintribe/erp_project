<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tbladdress;
use DB;
use Auth;
use App\Models\VendorModels\erp_vendor_address;


class VendorAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('call sp_getVendorAddress('.Auth::user()->id.')');
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
        if(empty(erp_vendor_address::where('vendor_id', $request->vendor_id)->first())){
            if($request->id){
            $address = $request->except('id', 'vendor_id','address_id', 'created_at', 'updated_at');
            $vendorAddress = $request->except('id', 'created_at', 'updated_at', 'address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code');
            tbladdress::where('id', $request->address_id)->update($address);
            erp_vendor_address::where('id', $request->id)->update($vendorAddress);
            return 'Update';
            }
            else{
            $address = $request->except('vendor_id','address_id');
            $vendorAddress = $request->except('address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code');
            $address = tbladdress::create($address);
            $vendorAddress['address_id'] = $address->id;
            $vendorAddress = erp_vendor_address::create($vendorAddress);
            }
            return 'Save';
        }else{
            return 'Vendor Address Already Exists';
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
       return erp_vendor_address::where('id', $id)->first();
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
        $det = erp_vendor_address::where('id', $id)->first();
        erp_vendor_address::where('id', $id)->delete();
        tbladdress::where('id', $det->address_id)->delete();
        return 'Vendor Address Delete Permanently';
    }
}

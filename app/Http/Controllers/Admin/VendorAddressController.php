<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tbladdress;
use DB;
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
        return erp_vendor_address::where('user_id', Auth::user()->id)->get();
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
        $address = $request->except('vendor_id');
        $vendorAddress = $request->except('address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code');
        $address = tbladdress::create($address);
        $vendorAddress['address_id'] = $address->id;
        $vendorAddress = erp_vendor_address::create($vendorAddress);
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


    public function getAddress($address_id)
    {
        return tbladdress::select('address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code')->where('id', $address_id)->first();
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

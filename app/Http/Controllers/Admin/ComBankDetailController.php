<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorModels\tblcompany_bankdetail;
use App\Models\tbladdress;
use App\Models\tblcontact;
use App\Models\tblsocialmedias;

class ComBankDetailController extends Controller
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
        return $request->all();
        if($request->id){
            $bankdetail = $request->except();
            $address = $request->except();
            $contact = $request->except();
            $social = $request->except();
        }else{
            $bankdetail = $request->except();
            $address = $request->except();
            $contact = $request->except();
            $social = $request->except();
            $addresses = tbladdress::create($address);
            $contacts = tblcontact::create($contact);
            $socials = tblsocialmedias::create($social);
            $bankdetail['com_id'] = $company->id;
            $bankdetail['address_id'] = $addresses->id;
            $bankdetail['contact_id'] = $contacts->id;
            $bankdetail['social_id'] = $socials->id;
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

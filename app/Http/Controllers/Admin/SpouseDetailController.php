<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\employeeCenter\erp_spouse_detail;
use App\Models\tbladdress;
use App\Models\tblcontact;
use DB;
class SpouseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('call sp_getEmploeeSpouse(0)');
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
        $addressdata = $request->except(['phone_number','mobile_number', 'fax_number', 'email', 'employee_id','spouse_first_name','spouse_middle_name','spouse_last_name','relation','gender','dob','domicile','marital_status','patronage']);
        $address = tbladdress::create($addressdata);
        $contactdata = $request->except(['address_line_1', 'address_line_2', 'address_line_3', 'street', 'sector', 'city', 'state', 'country', 'postal_code', 'zip_code', 'employee_id','spouse_first_name','spouse_middle_name','spouse_last_name','relation','gender','dob','domicile','marital_status','patronage']);
        $contact = tblcontact::create($contactdata);
        $spousedata = $request->except(['address_line_1', 'address_line_2', 'address_line_3', 'street', 'sector', 'city', 'state', 'country', 'postal_code', 'zip_code', 'phone_number','mobile_number', 'fax_number', 'email']);
        $spousedata['address_id'] = $address->id;
        $spousedata['contact_id'] = $contact->id;
        erp_spouse_detail::create($spousedata);
        return "Save";

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
        return erp_spouse_detail::where('id', $id)->first();
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

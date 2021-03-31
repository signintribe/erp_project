<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tbladdress;
use App\Models\tblcontact;
use App\Models\tblsocial_media;
use App\Models\employeeCenter\erp_employee_experience;
use Auth;
use DB;
class EmployeeExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('SELECT experiences.*, employee.first_name FROM (SELECT * FROM erp_employee_experiences WHERE user_id = '.Auth::user()->id.') AS experiences JOIN(SELECT id, first_name FROM tblemployeeinformations) AS employee ON employee.id = experiences.employee_id');
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
        $addressdata = $request->except(['phone_number','mobile_number', 'fax_number', 'email', 'employee_id','designation','organization','reference_number','worked_to','worked_from','total_period','remarks_employee']);
        $address = tbladdress::create($addressdata);
        $contactdata = $request->except(['address_line_1', 'address_line_2', 'address_line_3', 'street', 'sector', 'city', 'state', 'country', 'postal_code', 'zip_code', 'employee_id','designation','organization','reference_number','worked_to','worked_from','total_period','remarks_employee']);
        $contact = tblcontact::create($contactdata);
        $expdata = $request->except(['address_line_1', 'address_line_2', 'address_line_3', 'street', 'sector', 'city', 'state', 'country', 'postal_code', 'zip_code', 'phone_number','mobile_number', 'fax_number', 'email']);
        $expdata['address_id'] = $address->id;
        $expdata['contact_id'] = $contact->id;
        $expdata['user_id'] = Auth::user()->id;
        erp_employee_experience::create($expdata);
        return "Save Employee Experience";
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
        $exp = erp_employee_experience::where('id', $id)->first();
        tbladdress::where('id', $exp->address_id)->delete();
        tblcontact::where('id', $exp->contact_id)->delete();
        erp_employee_experience::where('id', $id)->delete();
        return 'Experience Delete Permanently';
    }
}
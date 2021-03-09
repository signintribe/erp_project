<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tbladdress;
use App\Models\tblcontact;
use App\Models\tblsocialmedias;
use App\Models\tblmaintain_office;
use DB;
use Auth;
class OfficeController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('call sp_getAlloffices('.Auth::user()->id.')');
    }

    public function maintain_office(){
        return view('admin.maintain-office');
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
        $adderss = new tbladdress();
        $adderss->address_line_1 = $request->address_line_1;
        $adderss->address_line_2 = $request->address_line_2;
        $adderss->street = $request->street;
        $adderss->sector = $request->sector;
        $adderss->city = $request->city;
        $adderss->state = $request->state;
        $adderss->country = $request->country;
        $adderss->postal_code = $request->postal_code;
        $adderss->zip_code = $request->zip_code;
        $adderss->save();
        $adderss_id = $adderss->id;

        $contact = new tblcontact();
        $contact->phone_number = $request->phone_number;
        $contact->mobile_number =$request->mobile_number;
        $contact->fax_number = $request->fax_number;
        $contact->whatsapp = $request->whatsapp;
        $contact->email = $request->email;
        $contact->save();
        $contact_id = $contact->id;

        $sm = new tblsocialmedias();
        $sm->website = $request->website;
        $sm->twitter = $request->twitter;
        $sm->instagram = $request->instagram;
        $sm->facebook = $request->facebook;
        $sm->linkedin = $request->linkedin;
        $sm->pinterest = $request->pinterest;
        $sm->save();
        $sm_id = $sm->id;

        $office = new tblmaintain_office();
        $office->company_id = $request->company_id;
        $office->office_name = $request->office_name;
        $office->office_type = $request->office_type;
        $office->start_date = $request->start_date;
        $office->office_status = $request->office_status;
        $office->scope_office =$request->scope_office;
        $office->address_id = $adderss_id;
        $office->contact_id = $contact_id;
        $office->social_id = $sm_id;
        $office->save();

        return 'Company Office Save Successfully';
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
        return tblmaintain_office::where('id', $id)->first();
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

    public function getoffice($company_id){
        return tblmaintain_office::where('company_id', $company_id)->get();
    }
}

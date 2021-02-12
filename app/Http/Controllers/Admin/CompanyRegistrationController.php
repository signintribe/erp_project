<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tblcompany_registration;
use DB;
use Auth;
class CompanyRegistrationController extends Controller
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
        return DB::select('call getAllregistration('.Auth::user()->id.')');
    }

    public function view_registration(){
        return view('admin.company-registration');
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
        $registration = tblcompany_registration::where('id', $request->id)->first();
        if(empty($registration)){
            $registration = new tblcompany_registration();
        }
        $registration->company_id = $request->company_id;
        $registration->registration_id = $request->registration_id;
        $registration->registration_name = $request->registration_name;
        $registration->registration_authority = $request->registration_authority;
        $registration->registration_date = $request->registration_date;
        $registration->expiry_date = $request->expiry_date;
        $registration->registration_authority_address = $request->registration_authority_address;
        $registration->website = $request->website;
        $registration->email = $request->email;
        $registration->phone_number = $request->phone_number;
        $registration->mobile_number = $request->mobile_number;
        $registration->save();
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
        return tblcompany_registration::where('id', $id)->first();
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
        tblcompany_registration::where('id', $id)->delete();
        return "Your record delete permanently";
    }
}

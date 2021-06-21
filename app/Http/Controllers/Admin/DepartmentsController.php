<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\tbldepartmen;
use App\Models\tbladdress;
use App\Models\tblcontact;
use App\Models\tblsocialmedias;
use DB;
use Auth;
/**
 * Description of DepartmentsController
 *
 * @author Attique
 */
class DepartmentsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin.departments');
    }

    public function SaveDepartment(Request $request) {
        $addr = $request->except(['office_id','department_name','description','start_date','department_scope','department_status','address_id','contact_id','social_id','phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'email', 'website', 'twitter', 'instagram', 'facebook', 'linkedin', 'pinterest']); 
        $cont = $request->except(['address_line_1', 'address_line_2', 'street', 'sector', 'city', 'state', 'country', 'postal_code', 'zip_code', 'office_id','department_name','description','start_date','department_scope','department_status','address_id','contact_id','social_id', 'website', 'twitter', 'instagram', 'facebook', 'linkedin', 'pinterest']); 
        $soc = $request->except(['address_line_1', 'address_line_2', 'street', 'sector', 'city', 'state', 'country', 'postal_code', 'zip_code', 'office_id','department_name','description','start_date','department_scope','department_status','address_id','contact_id','social_id', 'phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'email']);
        $adderss = tbladdress::where('id', $request->address_id)->first();
        if(empty($adderss)){
            $adderss = new tbladdress();
        }
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
        $address_id = $adderss->id;

        $contact = tblcontact::where('id', $request->contact_id)->first();
        $contact_id = $contact->id;

        $sm = tblsocialmedias::where('id', $request->social_id)->first();
        $social_id = $sm->id;

        tbldepartmen::create([
            'office_id' => $request->office_id,
            'department_name' => $request->department_name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'department_scope' => $request->department_scope,
            'department_status' => $request->department_status == 'true' ? 1 : 0,
            'address_id' => $address_id,
            'contact_id' => $contact_id,
            'social_id' => $social_id,
        ]);

        return "Department Save Successfully";
    }

    public function getdepartments() {
        return DB::select('call getAlldepartment(' . Auth::user()->id . ', 0)');
    }

    public function delete_department($deptid){
        $d = tbldepartmen::where('id', $deptid)->first();
        //tbladdress::where('id', $d->address_id)->delete();
    }

    public function getonedept($deptid){
        return DB::select('call getAlldepartment(' . Auth::user()->id . ', '.$deptid.')');;
    }

}

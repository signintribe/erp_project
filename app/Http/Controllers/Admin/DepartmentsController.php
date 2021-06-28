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
use App\Models\erp_employee_jd;
use App\Models\erp_maintain_shift;
use App\Models\tblcompany_calender;
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
        if($request->id){
            $addr = $request->except(['company_name', 'company_id', 'office_name', 'created_at', 'updated_at', 'office_id', 'id','department_name','description','start_date','department_scope','department_status','address_id','contact_id','social_id','phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'email', 'website', 'twitter', 'instagram', 'facebook', 'linkedin', 'pinterest']); 
            $cont = $request->except(['address_line_3', 'company_name', 'company_id', 'office_name', 'created_at', 'updated_at', 'address_line_1', 'id', 'address_line_2', 'street', 'sector', 'city', 'state', 'country', 'postal_code', 'zip_code', 'office_id','department_name','description','start_date','department_scope','department_status','address_id','contact_id','social_id', 'website', 'twitter', 'instagram', 'facebook', 'linkedin', 'pinterest']); 
            $soc = $request->except(['address_line_3', 'company_name', 'company_id', 'office_name', 'created_at', 'updated_at', 'address_line_1', 'id', 'address_line_2', 'street', 'sector', 'city', 'state', 'country', 'postal_code', 'zip_code', 'office_id','department_name','description','start_date','department_scope','department_status','address_id','contact_id','social_id', 'phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'email']);
            $dept = $request->except(['address_line_3', 'company_name', 'company_id', 'office_name', 'created_at', 'updated_at', 'address_id','contact_id','social_id', 'id', 'address_line_1', 'address_line_2', 'street', 'sector', 'city', 'state', 'country', 'postal_code', 'zip_code', 'phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'email', 'website', 'twitter', 'instagram', 'facebook', 'linkedin', 'pinterest']);
            $adderss = tbladdress::where('id', $request->address_id)->update($addr);
            $contact = tblcontact::where('id', $request->contact_id)->update($cont);
            $sm = tblsocialmedias::where('id', $request->social_id)->update($soc);
            $dept['department_status'] = $request->department_status == 'true' ? 1 : 0;
            tbldepartmen::where('id', $request->id)->update($dept);
        }else{
            $addr = $request->except(['office_id','department_name','description','start_date','department_scope','department_status','address_id','contact_id','social_id','phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'email', 'website', 'twitter', 'instagram', 'facebook', 'linkedin', 'pinterest']); 
            $cont = $request->except(['address_line_1', 'address_line_2', 'street', 'sector', 'city', 'state', 'country', 'postal_code', 'zip_code', 'office_id','department_name','description','start_date','department_scope','department_status','address_id','contact_id','social_id', 'website', 'twitter', 'instagram', 'facebook', 'linkedin', 'pinterest']); 
            $soc = $request->except(['address_line_1', 'address_line_2', 'street', 'sector', 'city', 'state', 'country', 'postal_code', 'zip_code', 'office_id','department_name','description','start_date','department_scope','department_status','address_id','contact_id','social_id', 'phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'email']);
            $dept = $request->except(['address_line_1', 'address_line_2', 'street', 'sector', 'city', 'state', 'country', 'postal_code', 'zip_code', 'phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'email', 'website', 'twitter', 'instagram', 'facebook', 'linkedin', 'pinterest']);
            $adderss = tbladdress::create($addr);
            $contact = tblcontact::create($cont);
            $sm = tblsocialmedias::create($soc);
            $dept['address_id'] = $adderss->id;
            $dept['contact_id'] = $contact->id;
            $dept['social_id'] = $sm->id;
            $dept['department_status'] = $request->department_status == 'true' ? 1 : 0;
            tbldepartmen::create($dept);
        }
        return "Department Save Successfully";
    }

    public function getdepartments() {
        return DB::select('call getAlldepartment(' . Auth::user()->id . ', 0)');
    }

    public function delete_department($deptid){
        try {
            $info = tbldepartmen::where('id', $deptid)->first();
            tbladdress::where('id', $info->address_id)->delete();
            tblcontact::where('id', $info->contact_id)->delete();
            tblsocialmedias::where('id', $info->social_id)->delete();
            erp_employee_jd::where('department_id', $deptid)->delete();
            erp_maintain_shift::where('department_id', $deptid)->delete();
            tblcompany_calender::where('department_id', $deptid)->delete();
            tbldepartmen::where('id', $deptid)->delete();
            return response()->json(['status' => true, 'message' => 'Dept delete permanently']);
          } catch (\Illuminate\Database\QueryException $e) {
              return response()->json(['status' => false, 'message' => $e->errorInfo[2]]);
          }
    }

    public function getonedept($deptid){
        return DB::select('call getAlldepartment(' . Auth::user()->id . ', '.$deptid.')');;
    }

    public function getDepts(){
        return tbldepartmen::get();
    }

}

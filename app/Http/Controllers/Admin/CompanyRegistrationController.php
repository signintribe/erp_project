<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\erp_actor_authority;
use App\Models\VendorModels\tblcompanydetail;
use DB;
use Auth;
use File;
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
        //return DB::select('call getAllregistration('.Auth::user()->id.')');
    }

    public function view_registration(){
        return view('company.company-registration');
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
        //return $request->all();
        $imgname = "";
        if ($request->hasFile('certificate_picture')) {
            $current = date('ymd') . rand(1, 999999) . time();
            $file = $request->file('certificate_picture');
            $imgname = $current . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/authorities_certificates'), $imgname);
            if($request->id){
                $file_path = public_path("authorities_certificates/" . $request->certificate_image);
                File::exists($file_path) ? File::delete($file_path) : '';
            }
        }  
        if($request->id){
            $data = $request->except(['id', 'created_at', 'updated_at', 'company_id', 'certificate_picture']);
            if($imgname != ""){
                $data['certificate_image'] = $imgname;
            }
            erp_actor_authority::where('id', $request->id)->update($data);
        }else{
            $data = $request->except(['certificate_picture']);
            $data['certificate_image'] = $imgname;
            erp_actor_authority::create($data);
        }
        return "Your information save successfully"; 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actor = explode('-', $id);
        if($actor['0'] == 'company'){
            return DB::select('SELECT actor_authority.*, company.company_name, authority.authority_name FROM (SELECT * FROM erp_actor_authorities where actor_name="'.$actor['0'].'" AND actor_id='.$actor['1'].') AS actor_authority JOIN (SELECT id, company_name FROM tblcompanydetails) AS company ON company.id = actor_authority.actor_id JOIN(SELECT id,  authority_name FROM erp_authorities) AS authority on authority.id = actor_authority.authority_id');
        }else if($actor['0'] == 'employee'){
            return DB::select('SELECT actor_authority.*, employee.employee_name, authority.authority_name FROM (SELECT * FROM erp_actor_authorities where actor_name = "'.$actor['0'].'" AND company_id = '.$actor['1'].') AS actor_authority JOIN (SELECT id, first_name AS employee_name FROM tblemployeeinformations) AS employee ON employee.id = actor_authority.actor_id JOIN(SELECT id,  authority_name FROM erp_authorities) AS authority on authority.id = actor_authority.authority_id');
        } else if($actor['0'] == 'sourcing'){
            return DB::select('SELECT actor_authority.*, logistics.organization_name, authority.authority_name FROM (SELECT * FROM erp_actor_authorities where actor_name = "'.$actor['0'].'" AND company_id = '.$actor['1'].') AS actor_authority JOIN (SELECT id, organization_name FROM erp_logistics) AS logistics ON logistics.id = actor_authority.actor_id JOIN(SELECT id,  authority_name FROM erp_authorities) AS authority on authority.id = actor_authority.authority_id');
        }else if($actor['0'] == 'vendor'){
            return DB::select('SELECT actor_authority.*, vendor.organization_name, authority.authority_name FROM (SELECT * FROM erp_actor_authorities where actor_name = "'.$actor['0'].'" AND company_id = '.$actor['1'].') AS actor_authority JOIN (SELECT id, organization_name FROM erp_vendor_informations) AS vendor ON vendor.id = actor_authority.actor_id JOIN(SELECT id,  authority_name FROM erp_authorities) AS authority on authority.id = actor_authority.authority_id');
        }else if($actor['0'] == 'customer'){
            return DB::select('SELECT actor_authority.*, customer.customer_name, authority.authority_name FROM (SELECT * FROM erp_actor_authorities where actor_name = "'.$actor['0'].'" AND company_id = '.$actor['1'].') AS actor_authority JOIN (SELECT id, customer_name FROM erp_customer_informations) AS customer ON customer.id = actor_authority.actor_id JOIN(SELECT id,  authority_name FROM erp_authorities) AS authority on authority.id = actor_authority.authority_id');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return erp_actor_authority::where('id', $id)->first();
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
        erp_actor_authority::where('id', $id)->delete();
        return "Your record delete permanently";
    }
}

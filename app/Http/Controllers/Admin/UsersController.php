<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersController
 *
 * @author Attique
 */

namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\tblcontact;
use App\Models\tblsocialmedias;
use App\Models\employeeCenter\tblemployeeinformation;
use App\Models\VendorModels\tblcompanydetail;
use Auth;

class UsersController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application users.
     *
     */
    public function index() {
        return view('employee_center.add_employees');
    }
    
    public function view_employees() {
        return view('admin.view_employees');
    }

//    public function getusers() {
//        return DB::select('call sp_users()');
//    }
    public function getEmployees() {
        $company = tblcompanydetail::select('id')->where('user_id', Auth::user()->id)->first();
        return tblemployeeinformation::where('company_id', $company->id)->get();
    }

    public function approve_user($user_id, $status) {
        $user = User::where('id', $user_id)->first();
        $user->is_verify = $status;
        $user->save();
        return "Status Change Successfully";
    }

    /* public function SaveUsers(Request $request) {
        //return  $request->all();
        $upusers = User::where('id', $request->id)->first();
        if (empty($upusers)) {
            $CheckUser = User::where('name', $request->name)->orWhere('email', $request->email)->first();
            if (empty($CheckUser)) {
                $user = User::create([
                    'name' => $request->first_name.' '.$request->middle_name.' ',$request->last_name,
                    'email' => $request->email,
                    'is_admin' => $request->user_type,
                    'is_verify' => 1,
                    'password' => bcrypt($request->password),
                ]);
                
                $contact = tblcontact::create([
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'mobile_number' => $request->mobile_number,
                    'fax_number' => $request->fax_number,
                    'whatsapp' => $request->whatsapp,
                ]);
                
                $social = tblsocialmedias::create([
                    'facebook' => $request->facebook,
                    'linkedin' => $request->linkedin,
                    'twitter' => $request->twitter,
                    'instgram' => $request->instgram,
                    'pinterest' => $request->pinterest,
                    'website' => $request->website,
                ]);
                $company = tblcompanydetail::select('id')->where('user_id', Auth::user()->id)->first();
                //$data['company_id'] = $company->id;
                tblemployeeinformation::create([
                    'company_id' => $company->id,
                    'employee_id' => $request->employee_id, 
                    'user_type' => $request->user_type,
                    'contact_id' => $contact->id,
                    'social_id' => $social->id,
                    'user_id' => $user->id,
                    'first_name' => $request->first_name, 
                    'middle_name' => $request->middle_name,
                    'last_name' => $request->last_name,
                    'father_name' => $request->father_name,
                    'religion' => $request->religion,
                    'sect' => $request->sect,
                    'next_of_kin' => $request->next_of_kin,
                    'dob' => $request->dob,
                    'nationality' => $request->nationality,
                    'marital_status' => $request->marital_status,
                    'domicile' => $request->domicile,
                    'proficiency_languages' => $request->proficiency_languages,
                    'gender' => $request->gender,
                    'cnic' => $request->cnic
                ]);
                return "User Add";
            } else {
                return "Not Save, User Name or Email Address Already Exist";
            }
        } else {
            $upusers->name = $request->name;
            $upusers->email = $request->email;
            $upusers->save();
        }
    } */

    public function SaveUsers(Request $request){
        $upusers = User::where('id', $request->id)->first();
        if(empty($upusers)){
            $CheckUser = User::where('name', $request->name)->orWhere('email', $request->email)->first();
            if(empty($CheckUser)){
                $user = User::create([
                    'name' => $request->first_name.' '.$request->middle_name.' ',$request->last_name,
                    'email' => $request->email,
                    'is_admin' => $request->user_type,
                    'is_verify' => 1,
                    'password' => bcrypt($request->password),
                ]);
                $company = tblcompanydetail::where('user_id', Auth::user()->id)->first();
                $info = $request->except('phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest');
                $contact = $request->except('website','twitter','instagram','facebook','linkedin','pinterest','company_id','employee_id','address_id', 'user_type','contact_id','social_id','user_id','first_name', 'middle_name', 'last_name','father_name', 'religion', 'sect','next_of_kin','dob', 'nationality','marital_status','domicile','proficiency_languages', 'gender', 'cnic');
                $social = $request->except('phone_number','mobile_number','fax_number','whatsapp','email','company_id','employee_id','address_id', 'user_type','contact_id','social_id','user_id','first_name', 'middle_name', 'last_name','father_name', 'religion', 'sect','next_of_kin','dob', 'nationality','marital_status','domicile','proficiency_languages', 'gender', 'cnic');
                $contacts = tblcontact::create($contact);                
                $socials = tblsocialmedias::create($social);
                $info['company_id'] = $company->id;
                $info['contact_id'] = $contacts->id;
                $info['social_id'] = $socials->id;
                $info['user_id'] = $user->id;
                tblemployeeinformation::create($info);                
                return 'User Created';
            }else{
                return 'Not Save, User Name or Email Address Already Exist';
            }
        }else{
            $upusers->name = $request->name;
            $upusers->email = $request->email;
            $upusers->save();
            $info = $request->except('id','password','user_id','instgram', 'phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest');
            $contact = $request->except('id','user_id','password','instgram', 'website','twitter','instagram','facebook','linkedin','pinterest','company_id','employee_id','address_id', 'user_type','contact_id','social_id','user_id','first_name', 'middle_name', 'last_name','father_name', 'religion', 'sect','next_of_kin','dob', 'nationality','marital_status','domicile','proficiency_languages', 'gender', 'cnic');
            $social = $request->except('id','user_id','password','instgram', 'phone_number','mobile_number','fax_number','whatsapp','email','company_id','employee_id','address_id', 'user_type','contact_id','social_id','user_id','first_name', 'middle_name', 'last_name','father_name', 'religion', 'sect','next_of_kin','dob', 'nationality','marital_status','domicile','proficiency_languages', 'gender', 'cnic');
            tblcontact::where('id', $request->id)->update($contact);
            tblsocialmedias::where('id', $request->id)->update($social);
            tblemployeeinformation::where('id', $request->id)->update($info);
        }
        return 'Update';
    }

    public function editEmployeeInfo($id){
        return tblemployeeinformation::where('id', $id)->first();
    }

    public function editContact($con_id){
        return tblcontact::select('phone_number','mobile_number','fax_number','whatsapp','email')->where('id', $con_id)->first();
    }

    public function editSocial($soc_id){
        return tblsocialmedias::select('website','twitter','instagram','facebook','linkedin','pinterest')->where('id', $soc_id)->first();

    }

    public function employeesRegistration()
    {
        return view('employee_center.employees-registration');
    }

}

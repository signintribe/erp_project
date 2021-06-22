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
        return tblemployeeinformation::get();
    }

    public function approve_user($user_id, $status) {
        $user = User::where('id', $user_id)->first();
        $user->is_verify = $status;
        $user->save();
        return "Status Change Successfully";
    }

    public function SaveUsers(Request $request) {
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
                $company = tblcompanydetail::where('user_id', Auth::user()->id)->first();
                //$data['company_id'] = $company->id;
                tblemployeeinformation::create([
                    'company_id' => $company->id,
                    'employee_id' => $request->employee_id, 
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
    }

}

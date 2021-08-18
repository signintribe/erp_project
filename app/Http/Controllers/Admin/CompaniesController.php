<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class CompaniesController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin.companies_reports');
    }
    
    public function get_all_companies(){
        return \App\Models\VendorModels\tblcompanydetail::orderBy('company_name', 'ASC')->get();
    }
    
    public function get_company_portfolio($company_id){
        return \App\Models\VendorModels\tblcompanyprotfolio::where('company_id', $company_id)->get();
    }
    
    public function get_company_socialmedia($company_id){
        return \App\Models\VendorModels\tblcompanysocial::where('company_id', $company_id)->first();
    }
    
    public function get_company_address($user_id){
        return \App\Models\VendorModels\tbladdress::where('user_id', $user_id)->first();
    }
    
    public function get_company_user($user_id){
        return \App\User::where('id', $user_id)->first();
    }
    
    public function your_company_profile(){
        return view('admin.your_company_profile');
    }

    public function bank_detail()
    {
        return view('company.bank-detail');
    }
}

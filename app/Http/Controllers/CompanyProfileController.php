<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\VendorModels\tblcompanydetail;
use App\Models\tblsocialmedias;
use App\Models\tbladdress;
use App\Models\tblcontact;

/**
 * Description of CompanyProfileController
 *
 * @author Attique
 */
class CompanyProfileController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('user.company_profile');
    }

    public function comAddressView(){
        return view('user.company-address');
    }

    public function comContactView(){
        return view('user.company-contact');
    }

    public function view_company() {
        return view('user.view-company');
    }

    public function comBankDetailView(){
        return view('user.bank-detail');
    }

    public function authortyLists()
    {
        return view('company.authorty-lists');
    }

    public function authorityContactPerson()
    {
        return view('company.authority-contact-person');
    }

    /**
     * 
     * @return type
     * Check user is approved or not
     */
    public function check_user_approve() {
        return User::select('is_verify')->where('id', Auth::user()->id)->first();
    }

    /**
     * 
     * @param Request $request
     * Save company information
     */
    public function SaveCompany(Request $request) {
        return $request->all();
        $company = tblcompanydetail::where('id', $request->id)->first();
        if (empty($company)) {
            if ($request->hasFile('companyLogo')) {
                $current = date('ymd') . rand(1, 999999) . time();
                $file = $request->file('companyLogo');
                $imgname = $current . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/company_logs'), $imgname);
            }
            $compan_detail = tblcompanydetail::create([
                        'user_id' => Auth::user()->id,
                        'company_name' => $request->company_name,
                        'office_timing' => $request->office_timing,
                        'established' => $request->established,
                        'desription' => $request->desription,
                        'company_logo' => $imgname
            ]);
            tbladdress::create([
                'address_line_1' => $request->address_line_1,
                'foreign_key' => $compan_detail->id,
                'address_line_2' => $request->address_line_2,
                'address_line_3' => $request->address_line_3,
                'street' => $request->street,
                'sector' => $request->sector,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city
            ]);

            tblcompanysocial::create([
                'facebook' => $request->facebook,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
                'twitter' => $request->twitter,
                'website' => $request->website,
                'company_id' => $compan_detail->id
            ]);
        } else {
            if ($request->hasFile('companyLogo')) {
                $current = date('ymd') . rand(1, 999999) . time();
                $file = $request->file('companyLogo');
                $imgname = $current . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/company_logs'), $imgname);
                $company->company_logo = $imgname;
            }
            $company->company_name = $request->company_name;
            $company->office_timing = $request->office_timing;
            $company->established = $request->established;
            $company->desription = $request->desription;
            $company->save();

            $address = tbladdress::where('foreign_key', $request->id)->first();
            $address->address_line_1 = $request->address_line_1;
            $address->address_line_2 = $request->address_line_2;
            $address->address_line_3 = $request->address_line_3;
            $address->street = $request->street;
            $address->sector = $request->sector;
            $address->country = $request->country;
            $address->state = $request->state;
            $address->city = $request->city;
            $address->save();

            $social = tblcompanysocial::where('company_id', $request->id)->first();
            $social->facebook = $request->facebook;
            $social->linkedin = $request->linkedin;
            $social->youtube = $request->youtube;
            $social->twitter = $request->twitter;
            $social->website = $request->website;
            $social->save();
        }
        return "Your comapny information save successfully";
    }

    public function check_company($company_name) {
        return tblcompanydetail::select('company_name')->where('company_name', $company_name)->first();
    }

    public function getcompanyinfo() {
        return tblcompanydetail::where('user_id', Auth::user()->id)->get();
    }

    public function getcompanysocial($social_id) {
        return tblsocialmedias::select('website', 'twitter', 'instagram', 'facebook', 'linkedin', 'pinterest')->where('id', $social_id)->first();
    }

    public function getcompanyaddress($address_id) {
        return tbladdress::select('address_line_1', 'address_line_2', 'address_line_3', 'street', 'sector', 'city', 'state', 'country', 'postal_code', 'zip_code')->where('id', $address_id)->first();
    }
    public function getcompanycontact($contact_id) {
        return tblcontact::select('phone_number', 'mobile_number', 'fax_number', 'whatsapp', 'email')->where('id', $contact_id)->first();
    }

    public function bankContactPerson()
    {
        return view('company.bank-contact-person');
    }
}

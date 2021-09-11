<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of VendorController
 *
 * @author Attique
 */
class VendorController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('vendor_center.vendor_information');
    }

    public function getVendors() {
        return erp_vendor_information::get();
    }
    
    public function organization_address() {
        return view('vendor_center.vendor_address');
    }
    
    public function organization_contact() {
        return view('vendor_center.vendor_contact');
    }
    
    public function contact_person() {
        return view('vendor_center.contact_person');
    }

    public function vendorRegistration()
    {
        return view('vendor_center.vendor-registration');
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use App\Models\CustomerModels\erp_customer_information;
/**
 * Description of CustomerController
 *
 * @author Attique
 */
class CustomerController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        return view('customer_center.customer_information');
    }
    
    public function customer_address(){
        return view('customer_center.customer_address');
    }
    
    public function contact_detail(){
        return view('customer_center.contact_detail');
    }
    
    public function customer_contact_person(){
        return view('customer_center.customer_contact_person');
    }

    public function customerBankDetail()
    {
        return view('customer_center.customer-bank-detail');
    }

    public function customerRegistration()
    {
        return view('customer_center.customer-registration');
    }

    public function search_customer($customer_name)
    {
        return erp_customer_information::where('customer_name', 'LIKE', $customer_name.'%')->get();
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Models\VendorModels\tblcompanydetail;
use App\Models\VendorModels\tblcustomerquery;

/**
 * Description of ApiController
 *
 * @author Attique
 */
class ApiController extends Controller {

    /**
     * 
     * @param type $category_id
     * @return type
     * Get categories for parent id
     */
    public function get_categories($category_id) {
        return $category_id;
        return DB::select('call sp_getchildcategoriesforcustomer("' . $category_id . '")');
    }

    /**
     * 
     * @param type $category_id
     * @return type
     * Get companies of category
     */
    public function get_companies($category_id) {
        return DB::select('call sp_getcompaniesofcategories("' . $category_id . '")');
    }

    /**
     * 
     * @param Request $request
     * @return string
     * Create new customer 
     */
    public function register_customer(Request $request) {
        $CheckUser = User::where('name', $request->name)->orWhere('email', $request->email)->first();
        if (empty($CheckUser)) {
            if (strpos($request['email'], "@") == false || $request['email'] == "") {
                $request['email'] = $request->phone_number . "@thaikadar.com";
            }
            $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'is_admin' => 2,
                        'is_verify' => 0,
                        'password' => bcrypt($request->password),
            ]);

            \App\Models\VendorModels\tblcustomerdetail::create([
                'user_id' => $user->id,
                'full_name' => $request->name
            ]);

            \App\Models\VendorModels\tbladdress::create([
                'user_id' => $user->id,
                'mobile_number' => $request->phone_number
            ]);

            return "User Add";
        } else {
            return "Not Save, User Name or Email Address Already Exist";
        }
    }

    /**
     * 
     * @param Request $request
     * @return string
     * Submit customer query
     */
    public function customer_query(Request $request) {
        $check = DB::select("SELECT count(id) as count_number FROM tblcustomerqueries WHERE customer_id = " . $request->customer_id . " AND DATE(created_at) = CURDATE()");
        if ($check[0]->count_number >= 15) {
            $array = array(
                'status' => 0,
                'message' => 'Sorry, Your Daily limit exceeded'
            );
            return $array;
        } else {
            tblcustomerquery::create([
                'category_id' => $request->category_id,
                'company_id' => $request->company_id,
                'customer_id' => $request->customer_id,
                'query_discription' => $request->query_discription,
                'status' => 'Pending',
                'lat' => $request->lat,
                'lang' => $request->lang
            ]);
            $array = array(
                'status' => 1,
                'message' => '“You have successfully submitted the Quotation Request. We will respond you asap',
                'customer_id' => $request->customer_id
            );
            return $array;
        }
    }

    public function get_complete_compnay_information($company_id) {
        return DB::select('call sp_getcompanyallinformations("' . $company_id . '")');
    }

    public function login_customer(Request $request) {
        if (strpos($request['email'], "@") == false) {
            $request['email'] = $request->email . "@thaikadar.com";
        }
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            if (auth()->user()->is_admin == 2) {
                return "login";
            }
        } else {
            return 'Email-Address And Password Are Wrong.';
        }
    }

    public function save_rated(Request $request) {
        \App\Models\tblcompanyrate::create([
            'customer_id' => $request->customer_id,
            'rated_vlaue' => $request->rated_vlaue,
            'rated_description' => $request->rated_description
        ]);

        $array = array(
            'status' => 1,
            'message' => 'Successfully Rated'
        );
        return $array;
    }

    public function get_company_rateing($company_id) {
        return DB::select("call sp_getcompanyrating(" . $company_id . ")");
    }

    public function searchCompany($company_name)
    {
        return tblcompanydetail::where('company_name', 'like', $company_name . '%')->limit(10)->get();
    }

    public function myCompany($company_id)
    {
        $data[] = DB::table('tblcompanydetails')
        ->leftJoin('tbladdresses', 'tbladdresses.id', '=', 'tblcompanydetails.address_id')
        ->where('tblcompanydetails.id', $company_id)
        ->select('tblcompanydetails.id','tblcompanydetails.company_name','tblcompanydetails.company_logo', 'tblcompanydetails.established', 'tbladdresses.address_line_1', 'tbladdresses.sector', 'tbladdresses.street', 'tbladdresses.country', 'tbladdresses.city', 'tblcompanydetails.created_at')
        ->first();

        return $data;
    }

}

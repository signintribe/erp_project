<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Auth;
use DB;

/**
 * Description of CustomerFeedbackController
 *
 * @author Attique
 */
class CustomerFeedbackController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('user.feedback');
    }

    public function all_company_feedback() {
        $company_id = \App\Models\VendorModels\tblcompanydetail::select('id')->where('user_id', Auth::user()->id)->first();
        if (!empty($company_id)) {
            return DB::select('call sp_companyfeedback(' . $company_id->id . ')');
        }
    }

}

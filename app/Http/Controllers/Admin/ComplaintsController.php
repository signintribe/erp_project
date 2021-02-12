<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
/**
 * Description of ComplaintsController
 *
 * @author Attique
 */
class ComplaintsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('admin.complaints');
    }
    
    public function get_all_complaints(){
        return DB::select('call sp_getcompanycomplaints()');
    }

}

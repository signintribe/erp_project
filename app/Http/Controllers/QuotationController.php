<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of QuotationController
 *
 * @author Attique
 */
class QuotationController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('quotation.add-quotation');
    }
    
    public function view_quotations(){
        return view('quotation.view-quotations');
    }

}

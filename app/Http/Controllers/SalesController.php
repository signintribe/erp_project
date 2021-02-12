<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of SalesController
 *
 * @author Attique
 */
class SalesController extends Controller{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('sales.add-sales-order');
    }
    
    public function view_sales_order(){
        return view('sales.view-sales-order');
    }
}

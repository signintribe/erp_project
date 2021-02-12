<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of PurchaseOrderController
 *
 * @author Attique
 */
class PurchaseOrderController extends Controller{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('purchase_order.add_purchaseorder');
    }
    
    public function add_purchase_receive(){
        return view('purchase_order.add_purchasereceive');
    }
    
    public function view_purchase_order(){
        return view('purchase_order.view_purchase_order');
    }
    
    public function view_purchase_receive(){
        return view('purchase_order.view_purchase_receive');
    }
}

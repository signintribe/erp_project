<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of InventoryController
 *
 * @author Attique
 */
class InventoryController extends Controller{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
       return view('inventory_center.add_inventory');
    }
    
    public function view_inventory() {
       return view('inventory_center.view_inventory');
    }
}

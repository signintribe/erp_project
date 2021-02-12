<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of MMController
 *
 * @author Attique
 */
class MMController extends Controller {

    public function __construct() {
        return $this->middleware('auth');
    }

    public function index() {
        return view('mm.store-requisition');
    }
    
    public function material_issue(){
        return view('mm.material-issue');
    }
    
    public function view_storerequisition(){
        return view('mm.view-storerequisition');
    }
    
    public function view_materialissue() {
        return view('mm.view-materialissue');
    }
    
    public function view_materialreturned(){
        return view('mm.view-materialreturned');
    }

}

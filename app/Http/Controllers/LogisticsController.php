<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of LogisticsController
 *
 * @author Attique
 */
class LogisticsController extends Controller {

    public function __construct() {
        return $this->middleware('auth');
    }

    public function index() {
        return view('logistic.freight-forward-det');
    }

    public function customer_clearance() {
        return view('logistic.customer-clearance');
    }

    public function carriage_company() {
        return view('logistic.carriage-company');
    }

    public function view_freight_forward_det() {
        return view('logistic.view-freight-forward-det');
    }

    public function view_customer_clearance() {
        return view('logistic.view-customer-clearance');
    }

    public function view_carriage_company() {
        return view('logistic.view-carriage-company');
    }

}

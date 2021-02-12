<?php

namespace App\Http\Controllers\User;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Description of UserController
 *
 * @author Attique
 */
class UserController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('subuser.userdashboard');
    }

}

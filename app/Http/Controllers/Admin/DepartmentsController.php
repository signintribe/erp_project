<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\tbldepartmen;
use DB;
use Auth;
/**
 * Description of DepartmentsController
 *
 * @author Attique
 */
class DepartmentsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin.departments');
    }

    public function SaveDepartment(Request $request) {
        tbldepartmen::create([
            'company_id' => $request->company_id,
            'department_name' => $request->department_name,
            'description' => $request->description
        ]);

        return "Department Save Successfully";
    }

    public function getdepartments() {
        return DB::select('call getAlldepartment(' . Auth::user()->id . ')');
    }

}

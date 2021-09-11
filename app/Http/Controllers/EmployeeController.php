<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of EmployeeController
 *
 * @author Attique
 */
class EmployeeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function add_employees_addresses() {
        return view('employee_center.add_employees_addresses');
    }

    public function spouse_detail() {
        return view('employee_center.spouse_detail');
    }

    public function education_detail() {
        return view('employee_center.education_detail');
    }

    public function certification_detail() {
        return view('employee_center.certification_detail');
    }

    public function experience_detail() {
        return view('employee_center.experience_detail');
    }

    public function organizational_assignment() {
        return view('employee_center.organizational_assignment');
    }

    public function pay_emoluments() {
        return view('employee_center.pay_emoluments');
    }
    
    public function employee_bank_detail() {
        return view('employee_center.employee_bank_detail');
    }
    
    public function job_description() {
        return view('employee_center.job_description');
    }
    
    public function tasks() {
        return view('employee_center.tasks');
    }
    
    public function employee_leave() {
        return view('employee_center.employee_leave');
    }

    public function employeeContactPerson()
    {
        return view('employee_center.employee-contact-person');
    }

}

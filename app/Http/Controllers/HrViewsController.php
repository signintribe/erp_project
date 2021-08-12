<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HrViewsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function timing_info()
    {
        return view('employee_center.timing-info');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TierController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function creation_tier()
    {
        return view('creation-tier');
    }

    public function task_tier()
    {
        return view('task-tier');
    }

    public function report_tier()
    {
        return view('report-tier');
    }

    public function user_auth_tier()
    {
        return view('user-auth-tier');
    }

    public function requestion()
    {
        return view('store-requestion');
    }
}

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
}

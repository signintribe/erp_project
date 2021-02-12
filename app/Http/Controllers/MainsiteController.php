<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainsiteController extends Controller
{
    public function aboutus(){
        return view('aboutus');
    }
    public function services(){
        return view('services');
    }
    public function contact(){
        return view('contact');
    }
}

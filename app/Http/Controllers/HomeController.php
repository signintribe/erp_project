<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('user.home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome() {
        return view('admin.adminHome');
    }

    public function status_company_queries($status) {
        $company = \App\Models\VendorModels\tblcompanydetail::where('user_id', Auth::user()->id)->first();
        if (!empty($company)) {
            $q = \App\Models\VendorModels\tblcustomerquery::where('status', $status)->where('company_id', $company->id)->get();
            return count($q);
        } else {
            return '0';
        }
    }

    public function all_customers() {
        $q = User::where('is_admin', 2)->get();
        return count($q);
    }

    public function all_queriesinadmin() {
        $q = \App\Models\VendorModels\tblcustomerquery::get();
        return count($q);
    }

    public function all_queriesstatusinadmin() {
        $q = \App\Models\VendorModels\tblcustomerquery::where('status', 'Accept')->get();
        return count($q);
    }

    public function all_companiesinadmin() {
        $q = User::where('is_admin', 0)->where('is_verify', 1)->get();
        return count($q);
    }

    public function get_all_totalrevenue() {
        return DB::select('SELECT SUM(price) as TotalRevenue FROM tblcustomerqueries');
    }

    public function get_my_totalrevenue() {
        $company_id = \App\Models\VendorModels\tblcompanydetail::where('user_id', Auth::user()->id)->first();
        return DB::select('SELECT SUM(price) as TotalRevenue FROM tblcustomerqueries WHERE company_id = ' . $company_id->id . '');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class QueriesController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin.queries_reports');
    }

    public function all_queries_report() {
        return DB::select('call sp_companyquery(0)');
    }

    public function search_queries(Request $request) {
        if ($request->status != '' && $request->todate == '' && $request->fromdate == '') {
//            return "Status";
            return DB::select('call sp_searchcompanyquery("' . $request->status . '", "0", "0")');
        } else if ($request->status == '' && $request->todate != '' && $request->fromdate == '') {
//            return "Todate";
            return DB::select('call sp_searchcompanyquery("0", "' . $request->todate . '", "0")');
        } else if ($request->status != '' && $request->todate != '' && $request->fromdate == '') {
//            return "Status Todate";
            return DB::select('call sp_searchcompanyquery("' . $request->status . '", "' . $request->todate . '", "0")');
        } else if ($request->status != '' && $request->todate != '' && $request->fromdate != '') {
//            return "All";
            return DB::select('call sp_searchcompanyquery("' . $request->status . '", "' . $request->todate . '", "' . $request->fromdate . '")');
        }
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\VendorModels\tblcustomerquery;
use App\Models\VendorModels\tblschedule;
use App\Models\VendorModels\tblfollowup;

/**
 * Description of CustomerQueriesController
 *
 * @author Attique
 */
class CustomerQueriesController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('user.queries');
    }

    /**
     * 
     * @return type
     * Get company queries
     */
    public function all_company_queries() {
        return DB::select('call sp_companyquery(' . Auth::user()->id . ')');
    }

    /**
     * 
     * @param type $query_id
     * @return type
     * Get specific query
     */
    public function specific_query($query_id) {
        return tblcustomerquery::where('id', $query_id)->first();
    }

    /**
     * 
     * @param type $query_id
     * @return type
     * Get query schedule
     */
    public function schedule_query($query_id) {
        return tblschedule::where('query_id', $query_id)->first();
    }

    /**
     * 
     * @param Request $request
     * @return string
     * Reply query to customer
     */
    public function save_query_status(Request $request) {
        $query = tblcustomerquery::where('id', $request->id)->first();
        $query->status = $request->status;
        $query->installing_date = $request->installing_date;
        $query->price = $request->price;
        $query->reject_comment = $request->reject_comment != '' ? $request->reject_comment : '';
        $query->save();

        $schedule = tblschedule::where('query_id', $request->id)->first();
        if (empty($schedule)) {
            tblschedule::create([
                'query_id' => $request->id,
                'schedule_date' => $request->schedule_date
            ]);
        } else {
            $schedule->schedule_date = $request->schedule_date;
            $schedule->save();
        }
        return "Success";
    }

    /**
     * 
     * @param Request $request
     * Add query follow up's
     */
    public function save_query_followup(Request $request) {
        $followup = tblfollowup::where('id', $request->id)->first();
        if (empty($followup)) {
            tblfollowup::create([
                'query_id' => $request->query_id,
                'follow_up' => $request->follow_up
            ]);
        } else {
            $followup->follow_up = $request->follow_up;
            $followup->save();
        }
        return "Follow up add";
    }

    public function get_query_followup($query_id) {
        return tblfollowup::where('query_id', $query_id)->orderBy('id', 'DESC')->get();
    }

    public function get_selected_category($category_id) {
        $category_ids = array();
        $category_last = \App\Models\tblcategoryassociation::where('child_id', $category_id)->first();
        if ($category_last->parent_id == 1) {
            $category_ids[] = $category_last->parent_id;
            $category_ids[] = $category_last->child_id;
        } else {
            $category_slast = \App\Models\tblcategoryassociation::where('child_id', $category_last->parent_id)->first();
            if ($category_slast->parent_id == 1) {
                $category_ids[] = $category_slast->parent_id;
                $category_ids[] = $category_last->parent_id;
                $category_ids[] = $category_id;
            } else {
                $category_tlast = \App\Models\tblcategoryassociation::where('child_id', $category_slast->parent_id)->first();
                if ($category_tlast->parent_id == 1) {
                    $category_ids[] = $category_slast->parent_id;
                    $category_ids[] = $category_last->parent_id;
                    $category_ids[] = $category_id;
                }
            }
        }

        return \App\Models\tblcategory::whereIn('id', $category_ids)->get();
    }

}

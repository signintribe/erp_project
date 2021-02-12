<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
/**
 * Description of SelectCategoryController
 *
 * @author Attique
 */
class SelectCategoryController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('user.select_category');
    }

    public function save_selected_categories(Request $request) {
        $catids = explode(',', $request->categoryids);
        foreach ($catids as $v) {
            \App\Models\VendorModels\tblselectedvendorcategory::where('category_id', $v)->delete();
            \App\Models\VendorModels\tblselectedvendorcategory::create([
                'company_id' => $request->company_id,
                'category_id' => $v
            ]);
        }
        return "Category Select Successfully";
    }

    public function get_company_categories($company_id) {
        return DB::select('call sp_getcompanyselectedcategories(' . $company_id . ')');
    }

    public function delete_selectedcategory($category_id){
        \App\Models\VendorModels\tblselectedvendorcategory::where('id', $category_id)->delete();
        return "Selected Category Delete Permanantely";
    }
}

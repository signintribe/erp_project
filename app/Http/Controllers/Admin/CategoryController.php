<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\tblcategory;
use App\Models\tblcategoryassociation;
use DB;

/**
 * Description of CategoryController
 *
 * @author Attique
 */
class CategoryController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin.categories');
    }

    public function get_parent_categories() {
        
    }

    public function save_category(Request $request) {
        $cat = tblcategory::where('id', $request->id)->first();
        $imgname = "";
        if (empty($cat)) {
            if ($request->hasFile('category_image')) {
                $current = date('ymd') . rand(1, 999999) . time();
                $file = $request->file('category_image');
                $imgname = $current . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/category_images'), $imgname);
            }
            $category = tblcategory::create([
                        'category_name' => $request->category_name,
                        'category_description' => $request->category_description,
                        'measurement' => $request->measurement,
                        'category_image' => $imgname
            ]);

            tblcategoryassociation::create([
                'child_id' => $category->id,
                'parent_id' => $request->parent_id ? $request->parent_id : 1
            ]);
        } else {
            if ($request->hasFile('category_image')) {
                $current = date('ymd') . rand(1, 999999) . time();
                $file = $request->file('category_image');
                $imgname = $current . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/category_images'), $imgname);
                $cat->category_image = $imgname;
            }
            $cat->category_name = $request->category_name;
            $cat->category_description = $request->category_description;
            $cat->measurement = $request->measurement;
            $cat->save();

            tblcategoryassociation::where('child_id', $request->id)->delete();

            tblcategoryassociation::create([
                'child_id' => $cat->id,
                'parent_id' => $request->parent_id ? $request->parent_id : 1
            ]);
        }
        return "Category Save Successfully";
    }

    public function get_categories($category_id) {
        return DB::select('call sp_categories("' . $category_id . '")');
    }

    public function get_categorywithitsparents($parent_id) {
        return DB::select('call sp_getchildcategories("' . $parent_id . '")');
    }

    public function delete_category($category_id) {
        tblcategoryassociation::where('child_id', $category_id)->delete();
        tblcategory::where('id', $category_id)->delete();
        return 'Category Delete Permanently';
    }

}

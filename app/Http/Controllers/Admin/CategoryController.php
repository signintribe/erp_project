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
use File;

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
    public function deleteOldImage($image)
    {
        $file_path = public_path("category_images/" . $image);
        File::exists($file_path) ? File::delete($file_path) : '';
    }

    public function save_category(Request $request) {
        $imgname = "";
        if ($request->hasFile('categoryimage')) {
            $current = date('ymd') . rand(1, 999999) . time();
            $file = $request->file('categoryimage');
            $imgname = $current . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/category_images'), $imgname);
            if($request->id){
                $this->deleteOldImage($request->category_image);
            }
        }
        if ($request->id) {
            $catdata = $request->except(['id', 'parent_id', 'category_image', 'category_id', 'parent_category_id', 'parent_category', 'categoryimage']);
            $catdata['category_image'] = $imgname;
            tblcategory::where('id', $request->id)->update($catdata);
            tblcategoryassociation::where('child_id', $request->id)->delete();
            tblcategoryassociation::create([
                'child_id' => $request->id,
                'parent_id' => $request->parent_id ? $request->parent_id : 1
            ]);
        } else {
            $catdata = $request->except(['parent_id', 'category_image']);
            $catdata['category_image'] = $imgname;
            $category = tblcategory::create($catdata);
            tblcategoryassociation::create([
                'child_id' => $category->id,
                'parent_id' => $request->parent_id ? $request->parent_id : 1
            ]);
        }
        $parent = tblcategoryassociation::where('parent_id', $request->parent_id)->get();
        if(!empty($parent)){
            $productcat['product_category'] = 0;
            tblcategory::where('id', $request->parent_id)->update($productcat);
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

    public function getCategory(){
        return tblcategory::where('product_category', 1)->get();
    }

}

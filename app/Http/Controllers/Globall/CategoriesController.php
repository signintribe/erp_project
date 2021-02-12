<?php

namespace App\Http\Controllers\Globall;

use Auth;
use DB;
use App\Models\tblmastercategories;
use App\Models\tblcategoryparentchildassociation;
use App\Models\tblattributecategoryassociation;
use App\Models\tblattributevalue;
use App\Models\tblattribute;
use App\Models\tblinventory_item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    //get categories-----done
    public function getCategories($id) {
        return $category = DB::select("call get_categoriesInDetails(" . $id . ")");
    }

    //get categories-----done
    public function getAccountCategories($id) {
        return $category = DB::select("call get_account_categories(" . $id . ")");
    }

    // save category in database
    public function save_category(Request $r) {
        if ($r->id) {
            return $this->update_category($r);
        } else {
            $category = new tblmastercategories;
            $category->CategoryName = $r->categoryname;
            $category->added_by = Auth::user()->id;
            $category->updated_by = Auth::user()->id;
            $category->product_category = 1;
            $category->save();
            $this->CreateAssociation($category->id, $r->ParendId);
            return 'Saved successfully';
        }
    }

    public function CreateAssociation($id, $ParendId) {
        $parent = tblcategoryparentchildassociation::where('CategoryChildId', $id)->first();
        if (!count($parent)) {
            $parent = new tblcategoryparentchildassociation;
        }
        $parent->CategoryChildId = $id;
        $parent->CategoryParentId = $ParendId;
        $parent->save();
        $m = tblmastercategories::find($ParendId);
        $m->product_category = 0;
        $m->save();
        return true;
    }

    public function update_category($r) {
        $category = tblmastercategories::find($r->id);
        $category->CategoryName = $r->categoryname;
        $category->updated_by = Auth::user()->id;
        $category->save();
        $id = $category->id;
        $this->CreateAssociation($category->id, $r->ParendId);
        if ($this->UpdateParentChild($id)) {
            return 'Update Successfuly';
        }
    }

    public function UpdateParentChild($id) {
        $find = tblcategoryparentchildassociation::where('CategoryChildId', $id)->get();
        $ok = count($find);
        if ($ok === 0) {
            $parent = new tblcategoryparentchildassociation;
            $parent->CategoryChildId = $id;
            $parent->CategoryParentId = 1;
            $parent->save();
        } elseif ($ok > 1) {
            $exist = false;
            foreach ($find as $cat) {
                if ($cat->CategoryParentId !== 1) {
                    $exist = true;
                }
            }
            if ($exist) {
                tblcategoryparentchildassociation::where(['CategoryParentId' => 1, 'CategoryChildId' => $id])->delete();
            }
        }
        return true;
    }

    public function delete_category($id) {
        $products = tblinventory_item::where('category_id',$id)->get()->count();
        $categoryParent = tblcategoryparentchildassociation::where('CategoryParentId', $id)->get()->count();
        if($products > 0){
            return $products.' products are associated So, can\'t delete';
        }elseif ($categoryParent > 0) {
            return $categoryParent . ' Categories are associated So, can\'t delete';
        } else {
            $this->deleteAttributes($id);
            $category = tblcategoryparentchildassociation::where('CategoryChildId', $id)->get();
            if(count($category) > 0){
                tblcategoryparentchildassociation::where('CategoryChildId', $id)->delete();
                $this->checkupdateproductcategories($category);
            }
            if (tblmastercategories::find($id)->delete()) {
                return 'success';
            } else {
                return 'There is some error can not delete';
            }
        }
    }

    public function checkupdateproductcategories($category) {
        if (count($category)) {
            foreach ($category as $cat) {
                $parents = tblcategoryparentchildassociation::where('CategoryParentId', $cat->CategoryParentId)->get();
                if (!count($parents)) {
                    $m = tblmastercategories::find($cat->CategoryParentId);
                    $m->product_category = 1;
                    $m->save();
                }
            }
        }
    }
    
    public function deleteAttributes($categoryid) {
	$associations = tblattributecategoryassociation::where('CategoryId',$categoryid)->get();
        if(!empty($associations)){
        foreach($associations as $association){
                tblattributevalue::where('association_id',$association->id)->delete();
                tblattribute::where('id',$association->AttributeId);
        }
            tblattributecategoryassociation::where('CategoryId',$categoryid)->delete();
        }
	return true;
    }
    
    public function ProductLavelCategories() {
        return tblmastercategories::where('product_category', 1)->get(['id', 'CategoryName']);
    }

}

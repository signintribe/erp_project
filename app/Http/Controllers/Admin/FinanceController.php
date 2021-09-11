<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\tblaccountcategories;
use App\Models\tblaccountparentchildassociations;
use App\Models\tblgeneralentries;
use Illuminate\Http\Request;
use App\Models\tbldepartments;
use DB;
use App\Http\Controllers\Controller;

/**
 * Description of Departments
 *
 * @author Attique
 */
class FinanceController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function defineAccount() {
        return view('Finance.views.defineaccount');
    }

    public function generalJournalEntry() {
        return view('Finance.views.addGeneralJournalEntries');
    }

    // save category in database
    public function save_category(Request $r) {
        //return $r->all();
        if ($r->id) {
            return $this->update_category($r);
        } else {
            //$category = $r->except(['credit', 'date', 'debit', 'ParentcategoryId']);
            $category = new tblaccountcategories();
            $category->AccountId = $r->AccountId;
            $category->CategoryName = $r->CategoryName;
            $category->AccountDescription = $r->AccountDescription;
            $category->added_by = Auth::user()->id;
            $category->updated_by = Auth::user()->id;
            $category->save();
            $this->CreateAssociation($category->id, $r->ParentcategoryId);
            DB::statement("call define_productline()");
            $gle = $r->except(['AccountId', 'AccountDescription', 'CategoryName', 'ParentcategoryId']);
            if(!empty($gle)){
                $gle['account_Id'] = $category->id;
                $gle['description'] = $r->AccountDescription;
                $gle['created_by'] = Auth::user()->id;
                tblgeneralentries::create($gle);
            }
            return 'Saved successfully';
        }

    }

    public function CreateAssociation($id, $ParentcategoryId) {
        $parent = tblaccountparentchildassociations::where('CategoryChildId', $id)->first();
        if (empty($parent)) {
            $parent = new tblaccountparentchildassociations;
        }
        $parent->CategoryChildId = $id;
        $parent->CategoryParentId = $ParentcategoryId;
        $parent->save();
        $m = tblaccountcategories::find($ParentcategoryId);
        $m->product_category = 0;
        $m->save();
        return true;
    }

    public function update_category($r) {
        $category = tblaccountcategories::find($r->id);
        $category->AccountId = $r->AccountId;
        $category->CategoryName = $r->CategoryName;
        $category->AccountDescription = $r->AccountDescription;
        $category->updated_by = Auth::user()->id;
        $category->save();
        $id = $category->id;
        $this->CreateAssociation($category->id, $r->ParentcategoryId);
        if ($this->UpdateParentChild($id)) {
            DB::statement("call define_productline()");
            return 'Update Successfuly';
        }
    }

    public function UpdateParentChild($id) {
        $find = tblaccountparentchildassociations::where('CategoryChildId', $id)->get();
        $ok = count($find);
        if ($ok === 0) {
            $parent = new tblaccountparentchildassociations;
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
                tblaccountparentchildassociations::where(['CategoryParentId' => 1, 'CategoryChildId' => $id])->delete();
            }
        }
        return true;
    }

    public function delete_category($id) {
//        $products = tblproductcategoriesassociation::where('category_id',$id)->get()->count();
        $categoryParent = tblaccountparentchildassociations::where('CategoryParentId', $id)->get()->count();
//        if($products > 0){
//            return $products.' products are associated So, can\'t delete';
//        }else
        if ($categoryParent > 0) {
            return $categoryParent . ' record(s) are associated So, can\'t delete';
        } else {
//            $this->deleteAttributes($id);
            $category = tblaccountparentchildassociations::where('CategoryChildId', $id)->get();

            if (tblaccountparentchildassociations::where('CategoryChildId', $id)->delete()) {
                $this->checkupdateproductcategories($category);
                $delete = tblaccountcategories::find($id);
                $delete->delete();
                return 'success';
            } else {
                return 'There is some error can not delete';
            }
        }
    }

    public function checkupdateproductcategories($category) {
        if (count($category)) {
            foreach ($category as $cat) {
                $parents = tblaccountparentchildassociations::where('CategoryParentId', $cat->CategoryParentId)->get();
                if (!count($parents)) {
                    $m = tblaccountcategories::find($cat->CategoryParentId);
                    $m->product_category = 1;
                    $m->save();
                }
            }
        }
    }

    function allaccountsTypes() {
        return DB::select("select id,CategoryName from tblaccountcategories where id in (select CategoryChildId from tblaccountparentchildassociations where CategoryParentId in(1,2))");
    }

    function subAccount($id) {
        return DB::select("select id,CategoryName from tblaccountcategories where id in (select CategoryChildId from tblaccountparentchildassociations where CategoryParentId = '$id')");
    }

    function AllchartofAccount() {
//        return DB::select("call getAccounts()");
        return $Accounts = DB::select('call getGLAccount()');
    }

    function SaveGeneralEntries(Request $r) {
        $date = $r->date;
        $refrance = $r->refrance;
//        return json_decode($r->Data);
        foreach ($r->Data as $collection):
            if (count($collection) > 2) {
                $collection['created_by'] = Auth::user()->id;
                $collection['refrance'] = $refrance;
                $collection['date'] = $date;
                $GeneralEntries = tblgeneralentries::create($collection);
//                $G_id = $GeneralEntries->id;
//                \App\LMSModels\tblstudentfeeintoaccount::where('gj_id', $G_id)->delete();
//                $saveuser = new \App\LMSModels\tblstudentfeeintoaccount();
//                if ($r->student_id != '') {
//                    $saveuser->user_id = $r->student_id;
//                    $saveuser->gj_id = $G_id;
//                    $saveuser->save();
//                }
            }
        endforeach;
        return $r->all();
    }

    public function defineUserAccount()
    {
        return view('Finance.user-chart-account');
    }

}

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
use App\Models\Finance\ErpGlDetail;
use App\Models\Finance\ErpGlprojectSystem;
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

    public function generalJournalEntry($payment_type) {
        return view('Finance.views.addGeneralJournalEntries', compact('payment_type'));
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
            //DB::statement("call define_productline()");
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
            //DB::statement("call define_productline()");
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
        $Accounts = DB::select('call getGLAccount()');
        $cat = DB::select('SELECT * FROM tblaccountcategories WHERE id IN (SELECT CategoryChildId FROM tblaccountparentchildassociations WHERE CategoryParentId IN(2,3))');
        $arr = array();
        $NewAccounts = array();
        foreach ($cat as $key => $value) {
            $child = DB::select('SELECT id FROM tblaccountcategories WHERE id IN (SELECT CategoryChildId FROM tblaccountparentchildassociations WHERE CategoryParentId = '.$value->id.')');
            foreach ($child as $key => $value) {
                $arr[] = $value->id;
            }
        }
        
        foreach ($Accounts as $key => $value) {
            if(!in_array($value->id, $arr)){
                $value->id = (int)$value->id;
                $value->AccountId = (int)$value->AccountId;
                $NewAccounts[] = $value;
            }
        }
        return $NewAccounts;
    }

    function SaveGeneralEntries(Request $r) {
        if(!empty($GeneralEntries = tblgeneralentries::where('invoice_number', $r->invoice_number)->first())){
            return response()->json([
                'status'=>false,
                'message'=>"Invoice number already in used, It should be unique invoice number"
            ]);
        }else{
            $date = $r->date;
            $invoice_number = $r->invoice_number;
            $refrance = $r->refrance;
            $GL = json_decode($r->Data,false);
            foreach ($GL as $collection):
                if (count($collection) > 2) {
                    unset($collection['$$hashKey']);
                    $collection['created_by'] = Auth::user()->id;
                    $collection['refrance'] = $refrance;
                    $collection['date'] = $date;
                    $collection['invoice_number'] = $invoice_number;
                    $GeneralEntries = tblgeneralentries::create($collection);
                }
            endforeach;
            $detail = $r->except(['Data', 'date', 'project_systems', 'deposit_slip']);
            if ($r->hasFile('deposit_slip')) {
                $current = date('ymd') . rand(1, 999999) . time();
                $file = $r->file('deposit_slip');
                $imgname = $current . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/deposit_slip'), $imgname);
                $detail['deposit_slip'] = $imgname;
            }
            $detail['invoice_number'] = $invoice_number;
            ErpGlDetail::create($detail);
            $project_systems = json_decode($r->project_systems,true);
            if(!empty($project_systems)){
                $project_systems['invoice_number'] = $invoice_number;
                ErpGlprojectSystem::create($project_systems);
            }
            return response()->json([
                'status'=>true,
                'message'=>"Entry Save Successfully"
            ]);
        }
    }

    public function defineUserAccount()
    {
        return view('Finance.user-chart-account');
    }

}

<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ErpCompanyBudgets;
use DB;
class CompanyBudgetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function budget()
    {
        return view('Finance.budget');
    }

    public function saveBudget(Request $request)
    {
        //return $request->all();
        if($request->id){
            $data = $request->except(['account_id', 'CategoryName', 'created_at', 'updated_at', '$$hashKey', 'id']);
            ErpCompanyBudgets::where('id', $request->id)->update($data);
            $budget = ErpCompanyBudgets::where('id', $request->id)->first();
            return response()->json([
                'status'=>true,
                'message'=>"Budget Update Successfully",
                'data'=> $budget
            ]);
        }else{
            $data = $request->all();
            $srch = ErpCompanyBudgets::where('account_id', $request->account_id)->first();
            if(empty($srch)){
                $budget = ErpCompanyBudgets::create($data);
                return response()->json([
                    'status'=>true,
                    'message'=>"Budget Save Successfully",
                    'data'=> $budget
                ]);
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>"Budget is already define against this account type",
                ]);
            }
        }
    }

    public function getAccountBudget()
    {
        $Accounts = DB::select('call getGLAccount()');
        $arr = array();
        foreach ($Accounts as $key => $value) {
            $srch = ErpCompanyBudgets::where('account_id', $value->id)->first();
            if(empty($srch)){
                $arr[] = $value;
            }
        }
        return $arr;
    }

    public function getBudgetDetail()
    {
        $budget = DB::select('SELECT category.CategoryName, budget.* FROM (SELECT * FROM erp_company_budgets) AS budget join(SELECT id, CategoryName FROM tblaccountcategories) AS category ON category.id = budget.account_id');
        $newbudget = array();
        foreach ($budget as $key => $value) {
            //echo $value->july;exit();
            $value->july = (float)$value->july;
            $value->august = (float)$value->august;
            $value->september = (float)$value->september;
            $value->october = (float)$value->october;
            $value->november = (float)$value->november;
            $value->december = (float)$value->december;
            $value->january = (float)$value->january;
            $value->february = (float)$value->february;
            $value->march = (float)$value->march;
            $value->april = (float)$value->april;
            $value->may = (float)$value->may;
            $value->june = (float)$value->june;
            $newbudget[] = $value;
        }
        return response()->json([
            'status'=>true,
            'message'=>'Added Budget',
            'data'=>$newbudget
        ]);
    }

    public function deleteBudget($budget_id)
    {
        ErpCompanyBudgets::where('id', $budget_id)->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Your Record Delete Permanently'
        ]);
    }
}

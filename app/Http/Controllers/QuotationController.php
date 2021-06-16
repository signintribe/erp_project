<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\erp_quotation;
use Auth;
use DB;

/**
 * Description of QuotationController
 *
 * @author Attique
 */
class QuotationController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('quotation.add-quotation');
    }
    
    public function view_quotations(){
        return view('quotation.view-quotations');
    }

    public function saveQuotation(Request $request)
    {
        //return $request->all();
        if($request->id){
            $data = $request->except('id', 'user_id');
            erp_quotation::where('id', $request->id)->update($data);
            return "Quotation Info Update Successfully";
        }else{
            $data = $request->all();
            $data['user_id'] = Auth::User()->id;
            erp_quotation::create($data);
        }
        return "Quotation Info Save Successfully";
    }

    public function deleteQuotation($id){
        erp_quotation::where('id', $id)->delete();
        return 'Quotation Info Delete permanently';
    }

    public function getQuotations(){
        return DB::select('SELECT quotation.*, vendor.company_name FROM (SELECT * FROM erp_quotations) AS quotation JOIN (SELECT id, company_name FROM erp_suppliers) AS vendor on vendor.id = quotation.vendor_name');
    }

    public function getEditQuotation($id){
        return view('quotation.edit-quotation', compact('id'));
    }

    public function getQuotation($id){
        return erp_quotation::where('id', $id)->first();
    }
}

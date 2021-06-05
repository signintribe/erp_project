<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\erp_purchase_order;
use Auth;
use DB;
/**
 * Description of PurchaseOrderController
 *
 * @author Attique
 */
class PurchaseOrderController extends Controller{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('purchase_order.add_purchaseorder');
    }
    
    public function add_purchase_receive(){
        return view('purchase_order.add_purchasereceive');
    }
    
    public function view_purchase_order(){
        return view('purchase_order.view_purchase_order');
    }
    
    public function view_purchase_receive(){
        return view('purchase_order.view_purchase_receive');
    }

    public function getpurchaseOrder(){
        return erp_purchase_order::all();
    }

    public function savePurchaseOrder(Request $request){
        //return $request->all();

        if($request->id){
            $data = $request->except(['id', 'user_id', 'created_at', 'updated_at']);
            erp_purchase_order::where('id', $request->id)->update($data);
        }else{
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            erp_purchase_order::create($data);
        }
        return "Purchase Order save successfully";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return erp_purchase_order::where('id', $id)->first();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        erp_purchase_order::where('id', $id)->delete();
        return "Your record delete permanently";
    }
}

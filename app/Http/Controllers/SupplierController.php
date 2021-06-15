<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\erp_supplier;
use Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return erp_supplier::get();

    }

    public function vendorIndex(){
        return view('vendor_center.add-vendor');
    }


    public function viewVendor(){
        return view('vendor_center.view-vendor');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        if($request->id){
            $data = $request->except('id', 'user_id');
            erp_supplier::where('id', $request->id)->update($data);
            return "Vendor Info Update Successfully";
        }else{
            $data = $request->all();
            $data['user_id'] = Auth::User()->id;
            erp_supplier::create($data);
        }
        return "Vendor Info Save Successfully";
    }

    public function vendorStatus($id,$status){
        $data = erp_supplier::where('id', $id)->first();
        $data->status = $status; 
        $data->save();
        return 'Status changed';
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function getVendor($id){
        return view('vendor_center.edit-vendor', compact('id'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return erp_supplier::where('id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        erp_supplier::where('id', $id)->delete();
        return 'Vendor Information Delete Permanently';
    }
}

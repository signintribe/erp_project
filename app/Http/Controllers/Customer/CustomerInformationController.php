<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use File;
use App\Models\CustomerModels\erp_customer_information;

class CustomerInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return erp_customer_information::where('user_id', Auth::user()->id)->get();
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
        $imageName = "";
        if ($request->hasFile('cust_logo')) {
            $current= date('ymd').rand(1,999999).time();
            $file= $request->file('cust_logo');
            $imageName = $current.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('customer_logo'), $imageName);
            if(!empty($request->id)){
                $this->deleteOldImage($request->customer_logo);
                $customer = erp_customer_information::where('id', $request->id)->first();
                $customer->customer_logo = $imageName;
                $customer->save();
            }
        }

        if($request->id){
            if ($imageName){
                $data['customer_logo'] = $imageName; 
            }
            $data = $request->except(['id', 'cust_logo','user_id', 'created_at', 'updated_at']);
            erp_customer_information::where('id', $request->id)->update($data);
            return 'Customer Information updated successfully';
        }else{
            $data = $request->except('cust_logo');
            $data['customer_logo'] = $imageName;
            $data['user_id'] = Auth::user()->id;
            //return $data;
            erp_customer_information::create($data);
        }
        return "Customer Information saved successfully";
    }


    public function deleteOldImage($request)
    {
        if(File::exists(public_path('customer_logo/'.$request))){
            $file =public_path('customer_logo/'.$request);
            $img=File::delete($file);
        }
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return erp_customer_information::where('id', $id)->first();
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
        erp_customer_information::where('id', $id)->delete();
        return "Your record delete permanently";
    }
}

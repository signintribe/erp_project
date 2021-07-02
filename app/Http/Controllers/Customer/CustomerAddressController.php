<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tbladdress;
use DB;
use Auth;
use App\Models\CustomerModels\erp_customer_address;

class CustomerAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('call sp_getCustomerAddress('.Auth::user()->id.')');
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
        if($request->id)
        {
        $address = $request->except('id', 'user_id', 'customer_id','address_id', 'created_at', 'updated_at');
        $customerAddress = $request->except('id', 'user_id', 'created_at', 'updated_at', 'address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code');
        tbladdress::where('id', $request->address_id)->update($address);
        erp_customer_address::where('id', $request->id)->update($customerAddress);
        return 'Update';
        }
        else{
        $address = $request->except('customer_id');
        $customerAddress = $request->except('address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code');
        $addresses = tbladdress::create($address);
        $customerAddress['address_id'] = $addresses->id;
        $customerAddress['user_id'] = Auth::user()->id;
        $customerAddress = erp_customer_address::create($customerAddress);
        }
        return 'Save';
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
        return erp_customer_address::where('id', $id)->first();
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
        $det = erp_customer_address::where('id', $id)->first();
        erp_customer_address::where('id', $id)->delete();
        tbladdress::where('id', $det->address_id)->delete();
        return 'Customer Address Delete Permanently';
    }
}

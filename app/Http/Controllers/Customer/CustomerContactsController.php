<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerModels\erp_customer_contacts;
use App\Models\tblcontact;
use App\Models\tblsocialmedias;
use Auth;
use DB;

class CustomerContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('call sp_getCustomerDetail('.Auth::user()->id.')');
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
        if(empty(erp_customer_contacts::where('customer_id', $request->customer_id)->first())){
            if($request->id){
               // $address = $request->except('id','customer_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest','created_at','updated_at','phone_number','mobile_number','fax_number','whatsapp','email');
                $contact = $request->except('id','customer_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest','created_at','updated_at');
                $customer = $request->except('id','phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest','created_at','updated_at');
                $social = $request->except('id','customer_id','contact_id','social_id','phone_number','mobile_number','fax_number','whatsapp','email','created_at','updated_at');
                tblcontact::where('id', $request->contact_id)->update($contact);
                tblsocialmedias::where('id', $request->social_id)->update($social);
                erp_customer_contacts::where('id', $request->id)->update($customer);
                return "Customer Contact Update Successfully";
            }
            else{
                $contact = $request->except('customer_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest');
                $customer = $request->except('phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest');
                $social = $request->except('customer_id','contact_id','social_id','phone_number','mobile_number','fax_number','whatsapp','email');
                $contact = tblcontact::create($contact);
                $social = tblsocialmedias::create($social);
                $customer['contact_id'] = $contact->id;
                $customer['social_id'] = $social->id;
                $customer = erp_customer_contacts::create($customer);
            }        
            return "Customer Contact Save Successfully";
        }else{
            return 'Customer Contact ALready Exists';
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
        return erp_customer_contacts::where('id', $id)->first();
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
        $det = erp_customer_contacts::where('id', $id)->first();
        erp_customer_contacts::where('id', $id)->delete();
        tblcontact::where('id', $det->contact_id)->delete();
        tblsocialmedias::where('id', $det->social_id)->delete();
        return 'Customer Detail Delete Permanently';
    }
}

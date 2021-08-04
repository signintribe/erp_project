<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use File;
use App\Models\CustomerModels\erp_customer_information;
use App\Models\CustomerModels\erp_customer_detail;
use App\Models\tbladdress;
use App\Models\tblcontact;
use App\Models\tblsocialmedias;

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
        //$cus_name = erp_customer_information::where('customer_name', $request->customer_name)->first();
        if(empty(erp_customer_information::where('customer_name', $request->customer_name)->first())){
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
                $data = $request->except(['id', 'cust_logo','user_id','created_at', 'updated_at']);
                erp_customer_information::where('id', $request->id)->update($data);
                return 'Customer Information updated successfully';
            }else{
                //$address = $request->except('customer_type','customer_name','ntn_no','incroporation_no','customer_logo','strn','import_license','export_license','chamber_no','currency_dealing','phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest','youtube');
               // $contact = $request->except('customer_type','customer_name','ntn_no','incroporation_no','customer_logo','strn','import_license','export_license','chamber_no','currency_dealing','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','website','twitter','instagram','facebook','linkedin','pinterest','youtube');
                //$social = $request->except('customer_type','customer_name','ntn_no','incroporation_no','customer_logo','strn','import_license','export_license','chamber_no','currency_dealing','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email',);
                $data = $request->except('cust_logo');
                $data['customer_logo'] = $imageName;
                $data['user_id'] = Auth::user()->id;
                erp_customer_information::create($data);
            }
            return "Customer Information saved successfully";
        }else{
            return 'Customer Information Already Exists';
        }
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

    public function getCustomer($cus_id){
        return DB::SELECT("Select cus.*, add.address_line_1,add.street,add.country,add.city FROM (select * FROM erp_customer_informations where id = '.$cus_id.') as cus JOIN(
            select * FROM erp_customer_details) as detail ON detail.customer_id = cus.id JOIN(
                select * FROM erp_customer_addresses) as address on address.customer_id = cus.id JOIN(
                    select * FROM tblcontacts) as contact ON contact.id = detail.contact_id JOIN(
                        select * FROM tblsocialmedias) as social ON social.id = detail.social_id JOIN(
                            select * FROM  tbladdresses) as add ON add.id = address.address_id");
    }
}

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
        //return $request->all();
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
            $data = $request->except(['id', 'company_id',  'address_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2', 'address_line_3', 'street','sector','city','state','country','postal_code','zip_code', 'cust_logo','user_id','created_at', 'updated_at']);
            $address = $request->except('id', 'customer_name', 'customer_logo', 'company_id', 'customer_type', 'address_id','contact_id','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','user_id','organization_name' ,'org_logo','currency_dealing','created_at','updated_at');
            $contact = $request->except('id', 'customer_name', 'customer_logo', 'company_id', 'customer_type', 'website','twitter','instagram','facebook','linkedin','pinterest','address_id','contact_id','social_id','address_line_1','address_line_2', 'address_line_3','street','sector','city','state','country','postal_code','zip_code','user_id','organization_name', 'org_logo','currency_dealing','created_at','updated_at');
            $social = $request->except('id', 'customer_name', 'customer_logo', 'company_id', 'customer_type','address_line_1', 'address_line_2', 'address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','user_id','address_id','contact_id','social_id','organization_name', 'org_logo', 'currency_dealing','created_at','updated_at');
            
            erp_customer_information::where('id', $request->id)->update($data);
            tbladdress::where('id', $request->address_id)->update($address);
            tblcontact::where('id', $request->contact_id)->update($contact);
            tblsocialmedias::where('id', $request->social_id)->update($social);
            return 'Customer Information updated successfully';
        }else{
            if(empty(erp_customer_information::where('customer_name', $request->customer_name)->first())){
                $address = $request->except('cust_logo','company_id', 'address_id','customer_type','contact_id','logo_file','social_id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','user_id','organization_name','org_logo','currency_dealing');
                $contact = $request->except('cust_logo','company_id', 'address_id','customer_type','website','twitter','logo_file','instagram','facebook','linkedin','pinterest','contact_id','social_id','address_line_1','address_line_2', 'address_line_3','street','sector','city','state','country','postal_code','zip_code','user_id','organization_name','org_logo','currency_dealing');
                $social = $request->except('cust_logo','company_id', 'address_line_1','customer_type','address_line_2', 'address_line_3','logo_file','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','user_id','address_id','contact_id','social_id','organization_name','org_logo','currency_dealing');
                $data = $request->except('cust_logo','phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest','youtube','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code');
                $data['customer_logo'] = $imageName;

                $address = tbladdress::create($address);
                $contact = tblcontact::create($contact);
                $social = tblsocialmedias::create($social);

                $data['user_id'] = Auth::user()->id;
                $data['address_id'] = $address->id;
                $data['contact_id'] = $contact->id;
                $data['social_id'] = $social->id;

                erp_customer_information::create($data);
            }else{
                return 'Customer Information Already Exists';
            }
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
    public function show($company_id)
    {
        return erp_customer_information::where('company_id', $company_id)->get();
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
        //return $cus_id;
        return DB::select("select customers.customer_name, adds.address_line_1,adds.street,adds.country,adds.city FROM (select id, customer_name FROM erp_customer_informations where id = '.$cus_id.') as customers JOIN(
            select id, address_id, customer_id FROM erp_customer_addresses) as address on address.customer_id = customers.id JOIN(
            select id, address_line_1, street, country, city FROM  tbladdresses) as adds ON adds.id = address.address_id");
    }
}

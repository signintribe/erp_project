<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tbladdress;
use App\Models\tblcontact;
use App\Models\tblsocialmedias;
use App\Models\VendorModels\tblcompanydetail;
use App\Models\erp_employee_address;
use App\Models\employeeCenter\tblemployeeinformation;
use DB;
use Auth;
class EmployeeAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $gtaddr = tbladdress::where('id', $request->id)->first();
        if(!empty($gtaddr)){
            $addressdata = $request->except(['id', 'first_name', 'last_name', 'middle_name', 'employee_id', 'employee_name', 'created_at', 'updated_at']);
            tbladdress::where('id', $request->id)->update($addressdata);
            return "Employee Address Update";
        }else{
            $employee = tblemployeeinformation::where('id', $request->employee_id)->first();
            if(!empty($employee)){
                $addressdata = $request->except(['employee_id']);
                $address = tbladdress::create($addressdata);
                
                $addressdata = array();
                $addressdata['employee_id'] = $request->employee_id;
                $addressdata['address_id'] = $address->id;
                erp_employee_address::create($addressdata);
                return "Employee Address Save";
            }else{
                return "Please Add Employee Information First";
            }
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
        return DB::select('call sp_getEmploeeAddress(0, '.$id.')');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = tblcompanydetail::select('id')->where('user_id', Auth::user()->id)->first();
        return DB::select('call sp_getEmploeeAddress('.$id.', '.$company->id.')');
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
        try {
            erp_employee_address::where('address_id', $id)->delete();
            tbladdress::where('id', $id)->delete();
            return response()->json(['status'=>true, 'message'=>'Employee Address Delete']);
          } catch (\Illuminate\Database\QueryException $e) {
              return response()->json(['status' => false, 'message' => substr($e->errorInfo[2], 0, 68)]);
          }
    }

    public function getAddress($address_id)
    {
        return tbladdress::select('address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code')->where('id', $address_id)->first();
    }

    public function getContact($contact_id)
    {
        return tblcontact::select('phone_number','mobile_number','fax_number','whatsapp', 'wechat', 'email')->where('id', $contact_id)->first();
    }

    public function getSocialMedia($social_id)
    {
        return tblsocialmedias::select('website','twitter','instagram','facebook','linkedin','pinterest')->where('id', $social_id)->first();
    }
}

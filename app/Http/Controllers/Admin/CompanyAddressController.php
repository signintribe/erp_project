<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tbladdress;
use App\Models\VendorModels\tblcompanydetail;
use App\Models\VendorModels\tblcompany_address;
use Auth;
use DB;

class CompanyAddressController extends Controller
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
        if($request->id){
            $data = $request->except('id','com_id','address_id','company_name');
            tbladdress::where('id', $request->address_id)->update($data);
            return 'Update';
        }else{
            $data = $request->all();
            $address = tbladdress::create($data);
            $comadd['com_id'] = $request->com_id;
            $comadd['address_id'] = $address->id;
            tblcompany_address::create($comadd);
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
        return DB::select('SELECT company.*, address.address_line_1,  address.address_line_2, address.address_line_3, address.street, address.sector, address.country, address.state, address.city FROM (SELECT * FROM tblcompany_addresses WHERE com_id = '.$id.') AS company JOIN (SELECT id, address_line_1, address_line_2, address_line_3, street, sector, country, state, city FROM tbladdresses) AS address on address.id = company.address_id');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return DB::select('SELECT company.*, cominfo.company_name, address.address_line_1,  address.address_line_2, address.address_line_3, address.street, address.sector, address.country, address.state, address.city, address.zip_code, address.postal_code FROM (SELECT * FROM tblcompany_addresses where id = '.$id.') AS company JOIN (SELECT id, company_name FROM tblcompanydetails WHERE user_id='.Auth::user()->id.') AS cominfo ON cominfo.id = company.com_id JOIN (SELECT id, address_line_1, address_line_2, address_line_3, street, sector, country, state, city, postal_code, zip_code FROM tbladdresses) AS address on address.id = company.address_id');
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
        $data = tblcompany_address::where('id', $id)->first();
        //return $data;
        tblcompany_address::where('id', $data->id)->delete();
        tbladdress::where('id', $data->address_id)->delete();
        return response()->json(['status'=>true, 'message'=>'Delete Successful']);
    }
}

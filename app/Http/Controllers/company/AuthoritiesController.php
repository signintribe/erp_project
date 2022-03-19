<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tbladdress;
use App\Models\tblcontact;
use App\Models\tblsocialmedias;
use App\Models\erp_authority;
use DB;

class AuthoritiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('SELECT authority.*, company.company_name, address.address_line_1, address.city FROM (SELECT * FROM erp_authorities) AS authority JOIN(SELECT id, company_name FROM tblcompanydetails) AS company ON company.id = authority.company_id JOIN(SELECT id, address_line_1, city FROM tbladdresses) AS address ON address.id = authority.address_id');
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
            $authoritydetail = $request->except('id','company_name','address_id','contact_id','social_id','company_id','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest','youtube', 'wechat', 'created_at','updated_at');
            $address = $request->except('id','company_id','company_name','address_id','contact_id','social_id','authority_name','phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest','youtube', 'wechat','created_at','updated_at');
            $contact = $request->except('id','company_id','company_name','address_id','contact_id','social_id','authority_name','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','website','twitter','instagram','facebook','linkedin','pinterest','youtube','created_at','updated_at');
            $social = $request->except('id','company_id','company_name','address_id','contact_id','social_id','authority_name','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp', 'wechat', 'email','created_at','updated_at');
            erp_authority::where('id', $request->id)->update($authoritydetail);
            tbladdress::where('id', $request->address_id)->update($address);
            tblcontact::where('id', $request->contact_id)->update($contact);
            tblsocialmedias::where('id', $request->social_id)->update($social);
        }else{
            $authoritydetail = $request->except('address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest','youtube', 'wechat');
            $address = $request->except('bank_name','phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest','youtube');
            $contact = $request->except('bank_name','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','website','twitter','instagram','facebook','linkedin','pinterest','youtube');
            $social = $request->except('bank_name','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email');
            $addresses = tbladdress::create($address);
            $contacts = tblcontact::create($contact);
            $socials = tblsocialmedias::create($social);
            $authoritydetail['company_id'] = $request->company_id;
            $authoritydetail['address_id'] = $addresses->id;
            $authoritydetail['contact_id'] = $contacts->id;
            $authoritydetail['social_id'] = $socials->id;
            erp_authority::create($authoritydetail);
        }
        return 'Authority Detail Save Successfully';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DB::select('SELECT authority.*, company.company_name, address.address_line_1, address.city FROM (SELECT * FROM erp_authorities WHERE company_id = '.$id.') AS authority JOIN(SELECT id, company_name FROM tblcompanydetails) AS company ON company.id = authority.company_id JOIN(SELECT id, address_line_1, city FROM tbladdresses) AS address ON address.id = authority.address_id');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return erp_authority::where('id', $id)->first();
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
            $authority = erp_authority::where('id', $id)->first();
            tbladdress::where('id', $authority->address_id)->delete();
            tblcontact::where('id', $authority->contact_id)->delete();
            tblsocialmedias::where('id', $authority->social_id)->delete(); 
            erp_authority::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'Authority List Delete Permanently']);
          } catch (\Illuminate\Database\QueryException $e) {
              return response()->json(['status' => false, 'message' => substr($e->errorInfo[2], 0, 68)]);
          }
    }
}

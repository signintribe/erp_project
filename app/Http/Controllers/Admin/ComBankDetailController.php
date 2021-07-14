<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorModels\tblcompany_bankdetail;
use App\Models\VendorModels\tblcompanydetail;
use App\Models\tbladdress;
use App\Models\tblcontact;
use App\Models\tblsocialmedias;
use Auth;
use DB;

class ComBankDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('SELECT bankdetail.*,company.company_name, addresses.address_line_1,addresses.address_line_2,addresses.address_line_3,addresses.street,addresses.sector,addresses.city,addresses.state,addresses.country,addresses.postal_code,addresses.zip_code, contacts.phone_number,contacts.mobile_number,contacts.fax_number,contacts.whatsapp,contacts.email, socials.website,socials.twitter,socials.instagram,socials.facebook,socials.linkedin,socials.pinterest,socials.youtube FROM (SELECT * FROM `tblcompany_bankdetails`) AS bankdetail JOIN(SELECT id,address_line_1,address_line_2,address_line_3,street,sector,city,state,country,postal_code,zip_code  FROM tbladdresses) AS addresses ON addresses.id = bankdetail.address_id JOIN(SELECT id,phone_number,mobile_number,fax_number,whatsapp,email FROM tblcontacts) AS contacts ON contacts.id = bankdetail.contact_id JOIN(SELECT id,website,twitter,instagram,facebook,linkedin,pinterest,youtube FROM tblsocialmedias) AS socials ON socials.id = bankdetail.social_id JOIN(SELECT id, company_name FROM tblcompanydetails) as company ON company.id = bankdetail.com_id');

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
        $company = tblcompanydetail::where('user_id', Auth::user()->id)->first();
        if($request->id){
            $bankdetail = $request->except('id','com_id','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest','youtube','created_at','updated_at');
            $address = $request->except('id','com_id','bank_name','phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest','youtube','created_at','updated_at');
            $contact = $request->except('id','com_id','bank_name','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','website','twitter','instagram','facebook','linkedin','pinterest','youtube','created_at','updated_at');
            $social = $request->except('id','com_id','bank_name','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','created_at','updated_at');
            tblcompany_bankdetail::where('id', $request->id)->update($bankdetail);
            tbladdress::where('id', $request->address_id)->update($address);
            tblcontact::where('id', $request->contact_id)->update($contact);
            tblsocialmedias::where('id', $request->social_id)->update($social);
            return 'Update';
        }else{
            $bankdetail = $request->except('address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest','youtube');
            $address = $request->except('bank_name','phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest','youtube');
            $contact = $request->except('bank_name','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','website','twitter','instagram','facebook','linkedin','pinterest','youtube');
            $social = $request->except('bank_name','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email');
            $addresses = tbladdress::create($address);
            $contacts = tblcontact::create($contact);
            $socials = tblsocialmedias::create($social);
            $bankdetail['com_id'] = $company->id;
            $bankdetail['address_id'] = $addresses->id;
            $bankdetail['contact_id'] = $contacts->id;
            $bankdetail['social_id'] = $socials->id;
            tblcompany_bankdetail::create($bankdetail);
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
        //
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
        //
    }
}

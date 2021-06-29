<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\erp_employee_bank_details;
use App\Models\tblsocialmedias;
use App\Models\tbladdress;
use App\Models\tblcontact;
use App\Models\employeCenter\tblemployeeinformation;
use Auth;
use DB;
use App\Models\VendorModels\tblcompanydetail;

class EmployeeBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = tblcompanydetail::select('id')->where('user_id', Auth::user()->id)->first();
        return DB::select('call sp_getEmployeeBankDetail(0, '.$company->id.')');
        //return DB::select('SELECT bankdetails.*, employee.first_name FROM (SELECT * FROM erp_employee_bank_details WHERE user_id = '.Auth::user()->id.') AS bankdetails JOIN(SELECT id, first_name FROM tblemployeeinformations) AS employee ON employee.id = bankdetails.employee_id');
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
            $bank_details= $request->except('address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest','id','user_id','address_id','contact_id','social_id');
            $social_medias= $request->except('address_line_1','user_id', 'address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','employee_id','account_title','bank_name','branch_name','branch_code','iban_no','bank_key','account_type','id','contact_id','social_id','address_id');
            $contacts= $request->except('address_line_1','user_id', 'address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','website','twitter','instagram','facebook','linkedin','pinterest','employee_id','id','account_title','bank_name','branch_name','branch_code','iban_no','bank_key','account_type','contact_id','social_id','address_id');
            $addresses= $request->except('phone_number','mobile_number','user_id', 'fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest','employee_id','account_title','bank_name','branch_name','branch_code','iban_no','bank_key','account_type','id','contact_id','social_id','address_id');
            tbladdress::where('id', $request->address_id)->update($addresses);
            tblcontact::where('id', $request->contact_id)->update($contacts);
            tblsocialmedias::where('id', $request->social_id)->update($social_medias);
            erp_employee_bank_details::where('id', $request->id)->update($bank_details);
            return 'Bank Details Update Successfully';
        }else{
            $bank_details= $request->except('address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest');
            $social_medias= $request->except('address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','phone_number','mobile_number','fax_number','whatsapp','email','employee_id','account_title','bank_name','branch_name','branch_code','iban_no','bank_key','account_type','contact_id','social_id','address_id');
            $contacts= $request->except('address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','website','twitter','instagram','facebook','linkedin','pinterest','employee_id','account_title','bank_name','branch_name','branch_code','iban_no','bank_key','account_type','contact_id','social_id','address_id');
            $addresses= $request->except('phone_number','mobile_number','fax_number','whatsapp','email','website','twitter','instagram','facebook','linkedin','pinterest','employee_id','account_title','bank_name','branch_name','branch_code','iban_no','bank_key','account_type','contact_id','social_id','address_id');
            $addresses = tbladdress::create($addresses);
            $contacts = tblcontact::create($contacts);
            $social_medias = tblsocialmedias::create($social_medias);

            $bank_details['address_id'] = $addresses->id;
            $bank_details['contact_id'] = $contacts->id;
            $bank_details['social_id'] = $social_medias->id;
            $bank_details['user_id'] = Auth::user()->id;
            //return $bank_details;
            $bank_details = erp_employee_bank_details::create($bank_details);
        }
         return 'Bank Details Save Successfully';
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
        return erp_employee_bank_details::where('id', $id)->first();
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
        $det = erp_employee_bank_details::where('id', $id)->first();
        erp_employee_bank_details::where('id', $id)->delete();
        tbladdress::where('id', $det->address_id)->delete();
        tblcontact::where('id', $det->contact_id)->delete();
        tblsocialmedias::where('id', $det->social_id)->delete();
        return 'Bank Details Delete Permanently';
    }
}

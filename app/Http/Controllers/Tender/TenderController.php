<?php

namespace App\Http\Controllers\Tender;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tender\ErpTender;
use App\Models\CreationTire\ErpTenderOrgContact;
use App\Models\CreationTire\ErpTenderContactPerson;
use App\Models\tbladdress;
use DB;
class TenderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tender.tender-information');
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
        //try{
            $imageName = "";
            if ($request->hasFile('tenderimg')) {
                $current= date('ymd').rand(1,999999).time();
                $file= $request->file('tenderimg');
                $imageName = $current.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('tender_docs'), $imageName);
                if(!empty($request->id)){
                    $this->deleteOldImage($request->tender_image);
                }
            }

            if($request->id){
                $data = $request->except(['id', 'address_id', 'address_line_3', 'tender_image', 'tenderimg', 'address_line_1', 'address_line_2', 'city', 'country', 'street', 'designation', 'email', 'facebook','fax_number', 'instagram', 'linkedin', 'mobile_number', 'org_email', 'org_facebook', 'org_fax_number', 'org_instagram', 'org_linkedin', 'org_mobile_number', 'org_pinterest', 'org_twitter', 'org_website', 'org_whatsapp', 'person_name', 'phone_number', 'phone_office', 'postal_code', 'sector','state', 'twitter', 'website', 'whatsapp', 'zip_code']);
                $data['tender_image'] = $imageName;
                ErpTender::where('id', $request->id)->update($data);
                $org_address = $request->except(['id', 'address_id', 'tenderimg', 'tender_image', 'advertisment_date', 'bid_money', 'bidmoney_mode', 'company_id', 'documents_required', 'expiry_date', 'issuance_date', 'opening_date', 'opening_time', 'opening_venue', 'submission_date', 'submission_time', 'tender_description', 'tender_fee', 'tender_name', 'tender_no', 'designation', 'email', 'facebook','fax_number', 'instagram', 'linkedin', 'mobile_number', 'org_email', 'org_facebook', 'org_fax_number', 'org_instagram', 'org_linkedin', 'org_mobile_number', 'org_pinterest', 'org_twitter', 'org_website', 'org_whatsapp', 'person_name', 'phone_number', 'phone_office', 'twitter', 'website', 'whatsapp']);
                tbladdress::where('id', $request->address_id)->update($org_address);
                $org_contact = $request->except(['id', 'address_id', 'address_line_3', 'tender_image', 'tenderimg', 'advertisment_date', 'bid_money', 'bidmoney_mode', 'company_id', 'documents_required', 'expiry_date', 'issuance_date', 'opening_date', 'opening_time', 'opening_venue', 'submission_date', 'submission_time', 'tender_description', 'tender_fee', 'tender_name', 'tender_no', 'address_line_1', 'address_line_2', 'city', 'country', 'street', 'postal_code', 'sector','state', 'zip_code', 'designation', 'email', 'facebook','fax_number', 'instagram', 'linkedin', 'mobile_number', 'person_name', 'phone_office', 'twitter', 'website', 'whatsapp']);
                ErpTenderOrgContact::where('tender_id', $request->id)->update($org_contact);
                $contact_person = $request->except(['id', 'address_id', 'address_line_3', 'tender_image', 'tenderimg', 'advertisment_date', 'bid_money', 'bidmoney_mode', 'company_id', 'documents_required', 'expiry_date', 'issuance_date', 'opening_date', 'opening_time', 'opening_venue', 'submission_date', 'submission_time', 'tender_description', 'tender_fee', 'tender_name', 'tender_no', 'address_line_1', 'address_line_2', 'city', 'country', 'street', 'postal_code', 'sector','state', 'zip_code', 'phone_number', 'org_email', 'org_facebook', 'org_fax_number', 'org_instagram', 'org_linkedin', 'org_mobile_number', 'org_pinterest', 'org_twitter', 'org_website', 'org_whatsapp', ]);
                ErpTenderContactPerson::where('id', $request->id)->update($contact_person);
            }else{
                $data = $request->except(['tenderimg', 'address_line_1', 'address_line_2', 'city', 'country', 'designation', 'email', 'facebook','fax_number', 'instagram', 'linkedin', 'mobile_number', 'org_email', 'org_facebook', 'org_fax_number', 'org_instagram', 'org_linkedin', 'org_mobile_number', 'org_pinterest', 'org_twitter', 'org_website', 'org_whatsapp', 'person_name', 'phone_number', 'phone_office', 'postal_code', 'sector','state', 'twitter', 'website', 'whatsapp', 'zip_code']);
                $data['tender_image'] = $imageName;
                $tender = ErpTender::create($data);
                $org_address = $request->except(['tenderimg', 'advertisment_date', 'bid_money', 'bidmoney_mode', 'company_id', 'documents_required', 'expiry_date', 'issuance_date', 'opening_date', 'opening_time', 'opening_venue', 'submission_date', 'submission_time', 'tender_description', 'tender_fee', 'tender_name', 'tender_no', 'designation', 'email', 'facebook','fax_number', 'instagram', 'linkedin', 'mobile_number', 'org_email', 'org_facebook', 'org_fax_number', 'org_instagram', 'org_linkedin', 'org_mobile_number', 'org_pinterest', 'org_twitter', 'org_website', 'org_whatsapp', 'person_name', 'phone_number', 'phone_office', 'twitter', 'website', 'whatsapp']);
                $address = tbladdress::create($org_address);
                $org_contact = $request->except(['tenderimg', 'advertisment_date', 'bid_money', 'bidmoney_mode', 'company_id', 'documents_required', 'expiry_date', 'issuance_date', 'opening_date', 'opening_time', 'opening_venue', 'submission_date', 'submission_time', 'tender_description', 'tender_fee', 'tender_name', 'tender_no', 'address_line_1', 'address_line_2', 'city', 'country', 'postal_code', 'sector','state', 'zip_code', 'designation', 'email', 'facebook','fax_number', 'instagram', 'linkedin', 'mobile_number', 'person_name', 'phone_office', 'twitter', 'website', 'whatsapp']);
                $org_contact['tender_id'] = $tender->id;
                $org_contact['address_id'] = $address->id;
                ErpTenderOrgContact::create($org_contact);
                $contact_person = $request->except(['tenderimg', 'advertisment_date', 'bid_money', 'bidmoney_mode', 'company_id', 'documents_required', 'expiry_date', 'issuance_date', 'opening_date', 'opening_time', 'opening_venue', 'submission_date', 'submission_time', 'tender_description', 'tender_fee', 'tender_name', 'tender_no', 'address_line_1', 'address_line_2', 'city', 'country', 'postal_code', 'sector','state', 'zip_code', 'phone_number', 'org_email', 'org_facebook', 'org_fax_number', 'org_instagram', 'org_linkedin', 'org_mobile_number', 'org_pinterest', 'org_twitter', 'org_website', 'org_whatsapp', ]);
                $contact_person['tender_id'] = $tender->id;
                ErpTenderContactPerson::create($contact_person);
            }
            return response()->json(['status' => true, 'message' => 'Tender Information Save Successfully']);
        /* } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status' => false, 'message' => substr($e->errorInfo[2], 0, 68)]);
        } */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($array)
    {
        try{
            $data = json_decode($array,true);
            $tenders = ErpTender::where('company_id', $data['company_id'])->skip($data['offset'])->take($data['limit'])->get();
            return response()->json([
            'status' => true, 
            'message' => 'All Tenders', 
            'data' => $tenders,
            'limit' => $data['limit'],
            'offset' => $data['offset']
        ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status' => false, 'message' => substr($e->errorInfo[2], 0, 68)]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tenders = ErpTender::where('id', $id)->first()->makeHidden(['created_at','updated_at' ]);
        $orgContact = ErpTenderOrgContact::where('tender_id', $tenders->id)->first()->makeHidden(['tender_id', 'id', 'created_at','updated_at' ]);
        $orgAddress = tbladdress::where('id', $orgContact->address_id)->first()->makeHidden(['id', 'created_at','updated_at' ]);
        $contactPerson = ErpTenderContactPerson::where('tender_id', $tenders->id)->first()->makeHidden(['tender_id', 'id', 'created_at','updated_at' ]);
        return response()->json([
            'status' => true, 
            'message' => 'All Tenders', 
            'tender' => $tenders,
            'orgContact' => $orgContact,
            'orgAddress' => $orgAddress,
            'contactPerson' => $contactPerson
        ]);
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
        try{
            $address = ErpTenderOrgContact::select('address_id')->first();
            ErpTenderContactPerson::where('tender_id', $id)->delete();
            tbladdress::where('id', $address->addess_id)->delete();
            ErpTenderOrgContact::where('tender_id', $id)->delete();
            ErpTender::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'Tender Information Delete Permanently']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status' => false, 'message' => substr($e->errorInfo[2], 0, 68)]);
        }
    }
}

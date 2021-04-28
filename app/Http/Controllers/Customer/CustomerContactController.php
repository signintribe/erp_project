<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tblcontact;
use App\Models\tbladdress;
use App\Models\tblsocialmedias;
use App\Models\CustomerModels\erp_customer_contactpersons;
use App\Models\CustomerModels\erp_customer_informations;
use DB;
Use File;
use Auth;

class CustomerContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('call sp_getCustomerContactPerson('.Auth::user()->id.')');
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
        if ($request->hasFile('picture')) {
            $current= date('ymd').rand(1,999999).time();
            $file= $request->file('picture');
            $imageName = $current.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('customercontactperson_picture'), $imageName);
            if(!empty($request->id)){
                $this->deleteOldImage($request->picture);
                $pics = erp_customer_contactpersons::where('id', $request->id)->first();
                $pics->picture = $imageName;
                $pics->save();
            }
        }
        if($request->id){
            $social = $request->except('id','customer_id','contact_id','social_id','address_id','title','first_name','last_name','picture','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','created_at','updated_at');
            $contact = $request->except('id','customer_id','contact_id','social_id','address_id','title','first_name','last_name','picture','website','twitter','instagram','facebook','linkedin','pinterest','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','created_at','updated_at');
            $address = $request->except('id','customer_id','contact_id','social_id','address_id','title','first_name','last_name','picture','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','created_at','updated_at');
            $contactperson = $request->except('id','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code','created_at','updated_at');
            tblsocialmedias::where('id', $request->social_id)->update($social);
            tblcontact::where('id', $request->contact_id)->update($contact);
            tbladdress::where('id', $request->address_id)->update($address);
            erp_customer_contactpersons::where('id', $request->id)->update($contactperson);
        }
        else{
            $social = $request->except('customer_id','contact_id','social_id','address_id','title','first_name','last_name','picture','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code',);
            $contact = $request->except('customer_id','contact_id','social_id','address_id','title','first_name','last_name','picture','website','twitter','instagram','facebook','linkedin','pinterest','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code',);
            $address = $request->except('customer_id','contact_id','social_id','address_id','title','first_name','last_name','picture','website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email');
            $contactperson = $request->except('website','twitter','instagram','facebook','linkedin','pinterest','phone_number','mobile_number','fax_number','whatsapp','email','address_line_1','address_line_2','address_line_3','street','sector','city','state','country','postal_code','zip_code');
            $social = tblsocialmedias::create($social);
            $contact = tblcontact::create($contact);
            $address = tbladdress::create($address);
            $contactperson['social_id'] = $social->id;
            $contactperson['contact_id'] = $contact->id;
            $contactperson['address_id'] = $address->id;
            $contactperson['picture'] = $imageName;
            $contactperson = erp_customer_contactpersons::create($contactperson);
        }
        

        return "Contact Person Save Successfully";
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function deleteOldImage($request)
    {
        if(File::exists(public_path('customercontactperson_picture/'.$request))){
            $file =public_path('customercontactperson_picture/'.$request);
            $img=File::delete($file);
        }
    }
    /* if(request()->hasFile('image') && request('image') != ''){
        $imagePath = public_path('storage/'.$post->image);
        if(File::exists($imagePath)){
            unlink($imagePath);
        }
        $image = request()->file('image')->store('uploads', 'public');
        $post->update([
            'title' => request()->title,
            'content' => request()->content,
            'image' => $image,
        ]); */
    

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
        return erp_customer_contactpersons::where('id', $id)->first();
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
        $det = erp_customer_contactpersons::where('id', $id)->first();
        erp_customer_contactpersons::where('id', $id)->delete();
        tblcontact::where('id', $det->contact_id)->delete();
        tblsocialmedias::where('id', $det->social_id)->delete();
        tbladdress::where('id', $det->address_id)->delete();
        return 'Contact Person Delete Permanently';
    }
}

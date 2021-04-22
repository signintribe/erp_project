<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\VendorModels\erp_vendor_information;

class VendorInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return erp_vendor_information::where('user_id', Auth::user()->id)->get();
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
        $imageName = "";
        if ($request->hasFile('organization_logo')) {
            $current= date('ymd').rand(1,999999).time();
            $file= $request->file('organization_logo');
            $imageName = $current.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('organization_logo'), $imageName);
            if(!empty($request->id)){
                $this->deleteOldImage($request->organization_logo);
                $vendor = erp_vendor_information::where('id', $request->id)->first();
                $vendor->organization_logo = $imageName;
                $vendor->save();
            }
        }

        if($request->id){
            if ($imageName){
                $data['organization_logo'] = $imageName; 
            }
            $data = $request->except(['id', 'user_id', 'created_at', 'updated_at']);
            erp_vendor_information::where('id', $request->id)->update($data);
        }else{
            $data = $request->all();
            $data['organization_logo'] = $imageName;
            $data['user_id'] = Auth::user()->id;
            //return $data;
            erp_vendor_information::create($data);
        }
        return "Vendor Information saved successfully";

    }


    public function deleteOldImage($request)
    {
        if(File::exists(public_path('organization_logo/'.$request))){
            $file =public_path('organization_logo/'.$request);
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
        return erp_vendor_information::where('id', $id)->first();
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
        erp_vendor_information::where('id', $id)->delete();
        return "Your record delete permanently";
    }
}

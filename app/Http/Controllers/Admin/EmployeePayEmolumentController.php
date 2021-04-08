<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\employeeCenter\erp_pay_emoluments;
class EmployeePayEmolumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('SELECT pay.*, emp.first_name FROM (SELECT id, first_name FROM tblemployeeinformations) AS emp JOIN (SELECT * FROM erp_pay_emoluments)AS pay ON pay.employee_id = emp.id WHERE pay.user_id = '.Auth::user()->id.'');
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
            $data = $request->except(['id', 'user_id', 'created_at', 'updated_at']);
            erp_pay_emoluments::where('id', $request->id)->update($data);
        }else{
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            erp_pay_emoluments::create($data);
        }
        return "Pay and Emloument save successfully";
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
        return erp_pay_emoluments::where('id', $id)->first();
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
        erp_pay_emoluments::where('id', $id)->delete();
        return "Your record delete permanently";
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\erp_attribute;
use App\Models\erp_attribute_value;
use Auth;
use DB;
class AttributeValuesController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function attributeValueView()
    {
        return view('admin.attribute_value');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('SELECT av.*, attr.category_id, attr.attribute_name, cat.category_name FROM (SELECT * FROM erp_attribute_values) AS av JOIN(SELECT id, category_id, attribute_name FROM erp_attributes) AS attr ON attr.id=av.attribute_id JOIN(SELECT id, category_name FROM tblcategories)AS cat ON cat.id=attr.category_id');
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
        if($request->id){
            $values = $request->except(['id', 'user_id']);
            erp_attribute_value::where('id', $request->id)->update($values);
        }else{
            $values = $request->all();
            $values['user_id'] = Auth::user()->id;
            erp_attribute_value::create($values);
        }
        return response()->json(['status'=>true, 'message' => 'Attribute Value Save Successfully']);
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
        return DB::select('SELECT av.*, attr.category_id, cat.category_name FROM (SELECT * FROM erp_attribute_values WHERE id='.$id.') AS av JOIN(SELECT id, category_id FROM erp_attributes) AS attr ON attr.id=av.attribute_id JOIN(SELECT id, category_name FROM tblcategories)AS cat ON cat.id=attr.category_id');
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
        erp_attribute_value::where('id', $id)->delete();
        return response()->json(['status' => true, 'message' => 'Value Delete Permanently']);
    }
}

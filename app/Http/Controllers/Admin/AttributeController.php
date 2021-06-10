<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\erp_attribute;
use App\Models\tblcategory;
use App\Models\erp_attribute_value;
use Auth;
use DB;
class AttributeController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function attributesView()
    {
        return view('admin.attributes');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('SELECT attribute.*, cat.category_name FROM (SELECT * FROM erp_attributes) AS attribute JOIN (select id, category_id, category_name FROM tblcategories) AS cat on cat.id = attribute.category_id');
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
            $attribute = $request->except(['id', 'user_id']);
            erp_attribute::where('id', $request->id)->update($attribute);
        }else{
            $attribute = $request->all();
            $attribute['user_id'] = Auth::user()->id;
            erp_attribute::create($attribute);
        }
        return response()->json(['status'=> true, 'message' => 'Attribute Save Successfully']);
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
        return erp_attribute::where('id', $id)->first();
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
        erp_attribute::where('id', $id)->delete();
        return response()->json(['status'=> true, 'message' => 'Attribute Delete Permanently']);
    }

    public function getAttrValues($category_id)
    {
        $attributes = array();
        $attr = erp_attribute::where('category_id', $category_id)->get();
        foreach ($attr as $key => $value) {
            $attrvalue = erp_attribute_value::where('attribute_id', $value['id'])->get();
            $attributes[] = array(
                $value['attribute_name'] => $attrvalue
            );
        }
        return response()->json(['status' => true, 'data' => $attributes]);
    }

    public function getAttributes($category_id)
    {
        return erp_attribute::where('category_id', $category_id)->get();
    }
}

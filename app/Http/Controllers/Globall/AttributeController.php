<?php

namespace App\Http\Controllers\Globall;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\tblattribute;
use App\Models\tblattributecategoryassociation;
use App\Models\tblattributevalue;
use App\Models\vwattributevaluesindex;
use App\Models\tblitemclass;
use App\Models\tblproductattributevalueassociations;
use App\Models\vwCategoriesAttributesValues;
use Auth;
use DB;
use Illuminate\Support\Facades\Input;

class AttributeController extends Controller {

    public function __construct() {
	$this->middleware('auth');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
	//
    }

    
    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
	$attribute = new tblattribute;
	$attribute->AttributeName = $request->AttributeName;
	$attribute->created_by = Auth::user()->id;
	$attribute->Active = 1;
	$attribute->save();
	$association = new tblattributecategoryassociation;
	$association->AttributeId = $attribute->id;
	$association->CategoryId = $request->assosiated;
	$association->save();
	$counter = 0;
	$limt = count($request->values);
	for ($counter; $counter < $limt; $counter++) {
	    $val = new tblattributevalue;
	    $val->AttirbuteValueName = $request->values[$counter]['value'];
	    $val->association_id = $association->id;
	    $val->created_by = Auth::user()->id;
	    $val->Active = 1;
	    $val->save();
	}
	return 'successfully Save';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
	return $data = tblattributecategoryassociation::with('tblattribute')->where('CategoryId', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
	
    }

    /**
     * Show the form for editing the specified resource.
     *
     **/

    /**
     * Update the specified resource in storage.
     * 
     **/
    public function AttributeValuesUpdate(Request $request) {

	$attribute = tblattribute::find($request->data[0]['AttributeId']);
	if (!empty($request->AttributeName)) {
	    $attribute->AttributeName = $request->AttributeName;
	    $attribute->save();
            $n = 0;
            foreach ($request->data as $r) {
		$val = tblattributevalue::find($r['id']);
		if (!empty($val)) {
		  $k =  $this->UpdateValue($val, $r);
                  $n = !$k ? $n++:$n;
		} else {
		    $this->CreatValue($r);
		}
	    }
                if($n){
                    $res = 'can\'t updated these values'; 
                }else{
                    $res = 'success';
                }
               
	} else {
	    $this->deleteAttribute($attribute, $request->data);
                    $res = 'Deleted Success';
	}
        return $res;
    }

    public function UpdateValue($val, $r) {
	if (!empty($r['AttirbuteValueName'])) {
	    $val->AttirbuteValueName = $r['AttirbuteValueName'];
	    $val->updated_by = Auth::user()->id;
	    $val->save();
            return true;
	} else {
            $v = tblproductattributevalueassociations::where('value_id', $r['id'])->get();
           if(count($v) > 0){
               return false;
           }else{
	    $val->delete();
               return true;
           }
	}
    }

    public function CreatValue($data) {
	if (!empty($data['AttirbuteValueName'])) {
	    $val = new tblattributevalue;
	    $val->AttirbuteValueName = $data['AttirbuteValueName'];
	    $val->association_id = $data['association_id'];
	    $val->created_by = Auth::user()->id;
	    $val->Active = 1;
	    $val->save();
	}
    }

    public function deleteAttribute($att, $data) {
	foreach ($data as $r) {
            tblproductattributevalueassociations::where('value_id', $r['id'])->delete();
	    $val = tblattributevalue::find($r['id']);
	    if (!empty($val)) {
		$val->delete();
	    }
	} 
	$association = tblattributecategoryassociation::find($data[0]['association_id']);
	    if (!empty($association)) {
		$association->delete();
	    }
	$att->delete();
	return true;
    }

    
    public static function GetAttributes($id) {
        $data = tblattributecategoryassociation::where('CategoryId', $id)->get();
        $i = 0;
        $attribute = array();
        foreach ($data as $d) {
            $attribute[$i]['Attribute'] = DB::select("SELECT id,AttributeName,association_id FROM vwCategoriesAttributesValues WHERE AttributeId = " . $d->AttributeId . " group by AttributeId");
            $attribute[$i]['val'] = DB::select("SELECT id,AttirbuteValueName,association_id FROM vwCategoriesAttributesValues WHERE AttributeId = " . $d->AttributeId . "");
            $i++;
        }
        return $attribute;
    }
    
    public function AttributeValues($id) {
        return vwCategoriesAttributesValues::where('AttributeId',$id)->get();
    }
    
    
    public function AttributeVaslueslog($type) {

       if ($type === 'created') {
            return vwattributevaluesindex::orderBy('id', 'DSEC')->paginate(25);
        } elseif ($type === 'updated') {
            return vwattributevaluesindex::where('updated_by_id', '!=', '')->orderBy('id', 'DSEC')->paginate(25);
        } elseif ($type === 'deleted') {
            return vwattributevaluesindex::where('Active', '0')->orderBy('id', 'DSEC')->paginate(25);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
	//
    }
    
    public function savedesignation($name) {
        $designation = new tbldesignation;
        $designation->name = $name;
        $designation->added_by = Auth::user()->id;
        $designation->sort = 0;
        $designation->save();
        return $designation;
    }
    
    public function updatedesignation(Request $r) {
        $designation = tbldesignation::find($r->id);
        $designation->name = $r->name;
        $designation->sort = $r->sort;
        $designation->save();
        return $designation;
    }
    public function updatedepartment(Request $r) {
        $department = department::find($r->id);
        $department->name = $r->name;
        $department->save();
        return $department;
    }
    public function designationstatus($name) {
        $designation = tbldesignation::where('name',$name)->get();
        return count($designation);
    }
    
    public function savedepartment($name) {
        $department = new department;
        $department->name = $name;
        $department->added_by = Auth::user()->id;
        $department->save();
        return $department;
    }
    public function departmentstatus($name) {
        $department = department::where('name',$name)->get();
        return count($department);
    }
    
    public function deletedesignation($id){
        tbldesignation::find($id)->delete();
        return 0;
    }
    
    public function deletedepartment($id){
        department::find($id)->delete();
        return 0;
    }
    public function ItemsClass(){
        return tblitemclass::get(['id','name']);
    }
}

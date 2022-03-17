<?php

namespace App\Http\Controllers\Globall;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreationTire\ErpSidebarMenu;
use App\Models\GlobalModel\SidebarChild;
use DB;

class RegisterAdminController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('super-admin.registar-admins');
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
        return $request->all();
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

    public function get_sidebar_menu()
    {
        $first = DB::select('SELECT * FROM erp_sidebar_menus WHERE id IN(SELECT child_id FROM sidebar_children WHERE parent_id = 1) ORDER BY menu_name ASC;');
        $second = array();
        $third = array();
        foreach($first as $key => $value){
            $second[$value->menu_name] = DB::select('SELECT * FROM erp_sidebar_menus WHERE id IN(SELECT child_id FROM sidebar_children WHERE parent_id = '.$value->id.') ORDER BY menu_name ASC;');
            foreach($second[$value->menu_name] as $key1 => $value1){
                $second[$value->menu_name][$value1->menu_name] = DB::select('SELECT * FROM erp_sidebar_menus WHERE id IN(SELECT child_id FROM sidebar_children WHERE parent_id = '.$value1->id.') ORDER BY menu_name ASC;');
            }
        }
        return $second;
    }
}

<?php

namespace App\Http\Controllers\Globall;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreationTire\ErpSidebarMenu;
use App\Models\GlobalModel\SidebarChild;
use DB;
class SidebarMenuController extends Controller
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
        return view('super-admin.create-sidebar-menu');
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
        try{
            if($request->id){
                $data = $request->except(['$$hashKey', 'created_at', 'updated_at', 'id', 'parent_id', 'parent_menu']);
                $category = ErpSidebarMenu::where('id', $request->id)->update($data);
                SidebarChild::where('child_id', $request->id)->delete();
                if($request->parent_id != ''){
                    SidebarChild::create([
                        'child_id'=> $request->id,
                        'parent_id'=>$request->parent_id
                    ]);
                    $parent = ErpSidebarMenu::where('id', $request->parent_id)->first();
                    $parent->is_child = 1;
                    $parent->save();
                }else{
                    SidebarChild::create([
                        'child_id'=> $request->id,
                        'parent_id'=>1
                    ]);
                }
            }else{
                $data = $request->except(['parent_id']);
                $category = ErpSidebarMenu::create($data);
                
                if($request->parent_id != ''){
                    SidebarChild::create([
                        'child_id'=> $category->id,
                        'parent_id'=>$request->parent_id
                    ]);
                    $parent = ErpSidebarMenu::where('id', $request->parent_id)->first();
                    $parent->is_child = 1;
                    $parent->save();
                }else{
                    SidebarChild::create([
                        'child_id'=> $category->id,
                        'parent_id'=>1
                    ]);
                }
            }
            return response()->json([
                'status'=>true,
                'message'=>'Menu Sessfully Save'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status' => false, 'message' => substr($e->errorInfo[2], 0, 400)]);
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
        //return $id;
        if($id == 0){
            return DB::select('SELECT * FROM erp_sidebar_menus WHERE id IN(SELECT child_id FROM sidebar_children WHERE parent_id = 1) ORDER BY menu_name ASC;');
        }else{
            return DB::select('SELECT menu.*, relation.parent_id, parent.menu_name AS parent_menu FROM (SELECT * FROM erp_sidebar_menus) AS menu JOIN(SELECT child_id, parent_id FROM sidebar_children WHERE parent_id = '.$id.') AS relation ON relation.child_id = menu.id JOIN(SELECT id, menu_name FROM erp_sidebar_menus) AS parent ON parent.id = relation.parent_id ORDER BY menu.menu_name ASC');
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
        try{
            SidebarChild::where('child_id', $id)->delete();
            ErpSidebarMenu::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'Menu Delete Permanently']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}

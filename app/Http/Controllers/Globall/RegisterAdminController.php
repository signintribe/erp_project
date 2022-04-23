<?php

namespace App\Http\Controllers\Globall;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreationTire\ErpSidebarMenu;
use App\Models\GlobalModel\SidebarChild;
use App\Models\GlobalModel\ErpUserMenu;
use App\User;
use App\Models\VendorModels\tblcompanydetail;
use DB;
use Auth;

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
        $forms = json_decode($request->forms, true);
        if($request->id){
            $user = $request->except('forms','company_name', 'created_at', 'id', 'updated_at');
            $company = $request->except('forms','name','email','password','is_admin', 'created_at', 'email_verified_at', 'id', 'is_verify', 'provider', 'provider_id', 'updated_at');
            User::where('id', $request->id)->update($user);
            tblcompanydetail::where('user_id', $request->id)->update($company);
            //sidebar menus
            if(!empty($forms)){
                ErpUserMenu::where('user_id', $request->id)->delete();
                for($i = 0; $i<count($forms); $i++){
                    $data['sidebar_menu_id'] = $forms[$i];
                    $data['user_id'] = $request->id;
                    ErpUserMenu::create($data);
                }
            }
        }else{
            //user
            $user = $request->except('forms','company_name');
            $user['password'] = bcrypt($request->password);
            $user = User::create($user);
            //company
            $company = $request->except('forms','name','email','password','is_admin');
            $company['user_id'] = $user->id;
            tblcompanydetail::create($company);
            //sidebar menus
            if(!empty($forms)){
                for($i = 0; $i<count($forms); $i++){
                    $data['sidebar_menu_id'] = $forms[$i];
                    $data['user_id'] = $user->id;
                    ErpUserMenu::create($data);
                }
            }
        }
        return response()->json(['status'=> 201,'success' => 'Successfully Create']);
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
        $second_level = array();
        foreach($first as $key => $value){
            $second[$value->menu_name] = DB::select('SELECT * FROM erp_sidebar_menus WHERE id IN(SELECT child_id FROM sidebar_children WHERE parent_id = '.$value->id.') ORDER BY menu_name ASC;');
            //return $second_level = $value->menu_name;
            foreach($second[$value->menu_name] as $key1 => $value1){
                //echo $value1->menu_name;
                $second_level[$value->menu_name][$value1->menu_name] = DB::select('SELECT * FROM erp_sidebar_menus WHERE id IN(SELECT child_id FROM sidebar_children WHERE parent_id = '.$value1->id.') ORDER BY menu_name ASC;');
            }
        }
        return $second_level;
    }

    public function getUserSidebarMenus($user_id, $menus)           
    {
        $user = User::where('id', $user_id)->first();
        $company = tblcompanydetail::select('company_name')->where('user_id', $user_id)->first();
        $data = DB::select('call sp_getusermenus('.$user_id.', 0,0,'.$menus.', 0)');
        $second = array();
        $second_level = array();
        foreach($data as $key => $value){
            $second[$value->tier_name] = DB::select('call sp_getusermenus('.$user_id.', 0,'.$menus.',0, '.$value->tier_id.')');
            //return $second_level = $value->menu_name;
            foreach($second[$value->tier_name] as $key1 => $value1){
                //echo $value1->menu_name;
                $second_level[$value->tier_name][$value1->module_name] = DB::select('call sp_getusermenus('.$user_id.', '.$menus.', 0, 0, '.$value1->module_id.')');
            }
        }
        return response()->json([
            'status' => true,
            'data' => $second_level,
            'user' => $user,
            'company' => $company
        ]);
    }

    public function get_users()
    {
        return DB::select('SELECT user.id, user.name, user.email, user.is_admin, company.company_name FROM(SELECT * FROM users WHERE is_admin IN(1, 4) AND id <> '.Auth::user()->id.') AS user JOIN(SELECT user_id, company_name FROM tblcompanydetails) AS company ON company.user_id = user.id');
    }

    public function getUserTires($user_id,$menus)
    {
        $data = DB::select('call sp_getusermenus('.$user_id.', 0,0,'.$menus.', 0)');
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function getUserModuleForms($user_id, $menus)
    {
        $user = User::where('id', $user_id)->first();
        $company = tblcompanydetail::select('company_name')->where('user_id', $user_id)->first();
        $data = DB::select('call sp_getusermenus('.$user_id.', 0,0,'.$menus.', 0)');
        $second = array();
        $second_level = array();
        foreach($data as $key => $value){
            $second = DB::select('call sp_getusermenus('.$user_id.', 0,'.$menus.',0, '.$value->tier_id.')');
            //return $second_level = $value->menu_name;
            foreach($second as $key1 => $value1){
                //echo $value1->menu_name;
                $second_level[$value->tier_link][$value1->module_name] = DB::select('call sp_getusermenus('.$user_id.', '.$menus.', 0, 0, '.$value1->module_id.')');
            }
        }
        return response()->json([
            'status' => true,
            'data' => $second_level,
            'user' => $user,
            'company' => $company
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use App\Models\user_types;
use App\Models\permission_role;
use App\Http\Controllers\Controller;
use Auth;
class PrivilegesController  extends Controller
{
    public function __construct()
    {
        
    }
    
     public function savepermission(Request $r) {
        $permission = new Permission();
        $permission->name = $r->name;
        $permission->created_by = Auth::user()->id;
        $permission->display_name = $r->display_name;
        $permission->description = $r->description;
        $permission->save();
        return $permission;
    }
    
    
    public function updatepermission(Request $r) {
        $permission = Permission::find($r->id);
        $permission->name = $r->name;
        $permission->display_name = $r->display_name;
        $permission->description = $r->description;
        $permission->save();
        return $permission;
    }
    public function permission() {
        return Permission::get(); 
    }
     
    public function saveRole(Request $r) {
        $Role = new Role();
        $Role->name = $r->name;
        $Role->created_by = Auth::user()->id;
        $Role->display_name = $r->display_name;
        $Role->description = $r->description;
        $Role->save();
        $permissions = json_decode($r->premissions);
        foreach($permissions as $key=>$v){
//            return $v;
            $p = new permission_role;
            $p->role_id = $Role->id;
            $p->permission_id = $v;
            $p->save();
        }
        return $Role;
    }
    public function updaterole(Request $r) {
        $Role = Role::find($r->id);
        $Role->name = $r->name;
        $Role->display_name = $r->display_name;
        $Role->description = $r->description;
        $Role->save();
        $deletepremissions = json_decode($r->deletepremissions);
        if(count($deletepremissions) > 0){
            permission_role::whereIn('permission_id',$deletepremissions)->where('role_id',$Role->id)->delete();
        }
        $permissions = json_decode($r->newpremissions);
        foreach($permissions as $key=>$v){
//            return $v;
            $p = new permission_role;
            $p->role_id = $Role->id;
            $p->permission_id = $v;
            $p->save();
        }
        return $Role;
    }
    
    public function roles(){
        return Role::get();
    }
    
    public function rolePermission($id){
        $data[] = permission_role::where('role_id',$id)->get();
        $data[] = Permission::get(); 
        return $data;
    }
    
    public function types(){
        return user_types::get();
        
    }
    
    public function save_user_types(Request $r){
        $user_type = $r->id ? user_types::find($r->id): new user_types;
        $user_type->type_name = $r->type_name;
        $user_type->save();
        return $user_type;
    }
    
    
    public function deletetype($id){
        user_types::find($id)->delete();
    }
    
    
    
    
    
    
    
    
    
    
}

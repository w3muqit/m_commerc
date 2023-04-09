<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class rolecontroller extends Controller
{
    function role(){
        $permissions= Permission::all();
        $roles= role::all();
        $users= User::all();
        return view('admin.role.role',[
            'permissions'=>$permissions,
            'roles'=>$roles,
            'users'=>$users,
        ]);
    }

    function permission_store(Request $request){
        $permission = Permission::create(['name' => $request->permission]);
        return back();
    }

    function role_store(Request $request){
        $role = Role::create(['name' => $request->role]);
        $role->givePermissionTo($request->permission);
        return back();
    }

    function asign_store(Request $request){
        $user=user::find($request->user_id);
        $user->assignRole($request->role_id);
        return back();

    }

    function remove_role($user_id){
        $user=User::find($user_id);
            $user->syncRoles([]);
            $user->syncPermissions([]);
            return back();

    }

    // function remove_permission($role_id){
    //     $role=role::find($role_id);
    //     $role->revokePermissionTo([]);
    //     $role->removeRole([]);
    // }

}

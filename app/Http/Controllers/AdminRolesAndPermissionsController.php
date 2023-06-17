<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

class AdminRolesAndPermissionsController extends Controller
{
    function index(){
        $roles = Role::all();
        return view('admin.rolesAndPermissions', compact('roles'));
    }

    function assignRole(Request $req){
        if($req->user == "select-user" && $req->role == "select-role")
            return redirect('/all-users')->with('message', 'Please select a User and a Role.');
        elseif($req->user == "select-user")
            return redirect('/all-users')->with('message', 'Please select a User.');
        elseif($req->role == "select-role")
            return redirect('/all-users')->with('message', 'Please select a Role.');
            

        $user = User::find($req->user);
        foreach($user->getRoleNames() as $role){
            if($role == $req->role)
                return redirect('/all-users')->with('message', 'User already has the role of '.$req->role);
        }
        $user->assignRole($req->role);
        return redirect('/all-users')->with('message', 'Specified role has been assigned to '.$user->name);
    }

    function selectRole(Request $req){
        $user = User::find($req->id);
        return view('admin.selectRole', compact('user'));
    }

    function destroy(Request $req){
        $user = User::find($req->id);
        $roles = $user->getRoleNames();
        if($roles->count() == 0)
            return redirect('/all-users')->with('message', 'User does not have any roles.');
        else{
            $user->removeRole($roles[$roles->count()-1]);
            return redirect('/all-users')->with('message', 'Role has been removed!');
        }
    }
}
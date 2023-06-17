<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    function index(){
        $users = User::all();
        $roles = Role::all();
        return view('admin.users', compact('users', 'roles'));
    }
}

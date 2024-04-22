<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // All Permissions
    public function allPermission()
    {
        $permissions = Permission::all();
        return view('backend.permission.all_permission',compact('permissions'));
    }
}

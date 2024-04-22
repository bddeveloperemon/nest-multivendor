<?php

namespace App\Http\Controllers\Backend\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
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

    // Add Permission
    public function addPermission()
    {
        return view('backend.permission.add_permission');
    }

    // Store Permission
    public function storePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'group_name' => 'required'
        ]);
        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
            'created_at' => Carbon::now()
        ]);
        toastr()->success('Permission Added Successfully');
        return redirect()->route('admin.all.permission');
    }

    // Edit Permission
    public function editPermission($id)
    {
        $permission = Permission::find($id);
        return view('backend.permission.edit_permission',compact('permission'));
    }

    // Update Permission
    public function updatePermission(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'group_name' => 'required'
        ]);
        $permission = Permission::find($id);
        $permission->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
            'updated_at' => Carbon::now()
        ]);
        toastr()->success('Permission Updated Successfully');
        return redirect()->route('admin.all.permission');
    }

    // Delete Permission
    public function deletePermission($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        toastr()->success('Permission Deleted Successfully');
        return redirect()->route('admin.all.permission');
    }

    ///Role Methods///

    // All Role
    public function allRole()
    {
        $roles = Role::all();
        return view('backend.role.all_role',compact('roles'));
    }

    // Add Role
    public function addRole()
    {
        return view('backend.role.add_role');
    }

    // Store Role
    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Role::create([
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);
        toastr()->success('Role Added Successfully');
        return redirect()->route('admin.all.role');
    }

    // Edit Role
    public function editRole($id)
    {
        $role = Role::find($id);
        return view('backend.role.edit_role',compact('role'));
    }

    // Update Role
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $role = Role::find($id);
        $role->update([
            'name' => $request->name,
            'updated_at' => Carbon::now()
        ]);
        toastr()->success('Role Updated Successfully');
        return redirect()->route('admin.all.role');
    }

    // Delete Role
    public function deleteRole($id)
    {
        $role = Role::find($id);
        $role->delete();
        toastr()->success('Role Deleted Successfully');
        return redirect()->route('admin.all.role');
    }

    ///Roles Permission Methods///

    // Add Role Permission
    public function addRolesPermission()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionsGroup();
        return view('backend.role.add_role_permission',compact('roles','permissions','permission_groups'));
    }

    // Store Role Permission
    public function storeRolesPermission(Request $request)
    {
        $data = array();
        foreach($request->permission as $key => $item){
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }
        toastr()->success('Role Permission Added Successfully');
        return redirect()->route('admin.all.roles.permission');
    }

    // All Role Permission
    public function allRolesPermission()
    {
        $roles = Role::all();
        return view('backend.role.all_role_permission',compact('roles'));
    }

    // Edit Role Permission
    public function editRolesPermission($id)
    {
        $role = Role::find($id);
        $permission = Permission::all();
        $permission_groups = User::getPermissionsGroup();
        return view('backend.role.edit_role_permission',compact('role','permission_groups','permission'));
    }

    // Update Role Permission
    public function updateRolesPermission(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;
    
        // Filter out invalid permission IDs
        $validPermissions = Permission::whereIn('id', $permissions)->pluck('id')->toArray();
    
        // Sync only valid permissions
        $role->syncPermissions($validPermissions);
    
        toastr()->success('Role Permission Updated Successfully');
        return redirect()->route('admin.all.roles.permission');
    }
    
}

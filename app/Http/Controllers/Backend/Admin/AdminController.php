<?php

namespace App\Http\Controllers\Backend\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\AdminProfileRequest;
use App\Http\Requests\AdminUpdatePasswordRequest;

class AdminController extends Controller
{
    //Admin Dashboard Method
    public function AdminDashboard(): View
    {
        return view('backend.admin.index');
    }

    //Admin Login Page
    public function adminLogin(): View
    {
        return view('backend.admin.login');
    }

    // Admin Logout Method
    
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect('/admin/login');
    }

    // Admin Profile Method
    public function adminProfile(): view
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('backend.admin.profile',compact('adminData'));
    }

    // Admin Profile Update Method
    public function adminProfileStore(AdminProfileRequest $request): RedirectResponse
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        if($request->hasFile('image')){
            if(File::exists(public_path('upload/admin_images/'.Auth::user()->image))){
                File::delete(public_path('upload/admin_images/'.Auth::user()->image));
            }
            $manager = new ImageManager(new Driver());
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = strtolower(str_replace(' ','_',Auth::user()->name)).'.'.$extension;
            $imagePath = public_path('upload/admin_images').'/'.$imageName;
            $make_img = $manager->read($request->file('image'));
            $make_img->save($imagePath);
    
            $adminData->image = $imageName;
        }
        $adminData->name    = $request->name;
        $adminData->email   = $request->email;
        $adminData->phone   = $request->phone;
        $adminData->address = $request->address;
        $adminData->save();
        toastr()->success('You data has been save successfully');
        return redirect()->back();
    }

    // Admin Password Change Method
    public function adminChangePassword(): View
    {
        return view('backend.admin.password_change');
    }

    // Admin Password Update Method
    public function adminPasswordUpdate(AdminUpdatePasswordRequest $request): RedirectResponse
    {
        //match current password
        if(!Hash::check($request->current_password, auth()->user()->password)){
            return redirect()->back()->with('error', 'Current password does not match');
        }

        //update password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('success', 'Password changed successfully');
    }

    // Vendor Inactive Method
    public function inactiveVendor(): View
    {
        $inactive_vendors = User::where(['status' => 'inactive','role'=> 'vendor'])->latest()->get();
        return view('backend.vendor.inactive_vendor',compact('inactive_vendors'));
    }

    // Vendor Active Method
    public function activeVendor(): View
    {
        $active_vendors = User::where(['status' => 'active','role'=> 'vendor'])->latest()->get();
        return view('backend.vendor.active_vendor',compact('active_vendors'));
    }

    // Inactive Vendor Details Method
    public function inactiveVendorDetails($id): View
    {
        $inactiveVendorDetails = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details',compact('inactiveVendorDetails'));
    }

    // Active Vendor Details Method
    public function activeVendorDetails($id): View
    {
        $activeVendorDetails = User::findOrFail($id);
        return view('backend.vendor.active_vendor_details',compact('activeVendorDetails'));
    }

    // Inactive Vendor Active Method
    public function activeVendorApprove(Request $request,$id): RedirectResponse
    {
        User::findOrFail($id)->update([
            'status' => 'active'
        ]);

        toastr()->success('Vendor Active');
        return redirect()->route('admin.vendor.active');
    }

    // Active Vendor Inactive Method
    public function inactiveVendorApprove(Request $request,$id): RedirectResponse
    {
        User::findOrFail($id)->update([
            'status' => 'inactive'
        ]);

        toastr()->success('Vendor Inactive');
        return redirect()->route('admin.vendor.inactive');
    }

    // All Admin
    public function allAdmin()
    {
        $allAdminUsers = User::where('role','admin')->latest()->get();
        return view('backend.admin.admin_user.all_admin',compact('allAdminUsers'));
    }

    // Add Admin
    public function addAdmin()
    {
        $roles = Role::all();
        return view('backend.admin.admin_user.add_admin',compact('roles'));
    }

    // Store Admin User
    public function storeAdminUser(AdminRequest $request)
    {
        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'role' => 'admin',
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'status' => 'active',
            'created_at' => Carbon::now(),
        ];
        $user = User::create($userData);
        $role = Role::find($request->roles);
        $user->assignRole($role);
        toastr()->success('Admin User Inserted Successfully');
        return redirect()->route('admin.all.addmin');
    }

    // Edit Admin Role
    public function editAdminRole($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.admin.admin_user.edit_admin',compact('roles','user'));
    }

    // Update Admin Role
    public function updateAdminRole(Request $request, $id)
    {
        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'role' => 'admin',
            'phone' => $request->phone,
            'status' => 'active',
            'created_at' => Carbon::now(),
        ];
        
        User::find($id)->update($userData);
        $user = User::find($id);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $role = Role::find($request->roles);
        $user->assignRole($role);
        

        toastr()->success('Admin User Upda Successfully');
        return redirect()->route('admin.all.addmin');
    }
}

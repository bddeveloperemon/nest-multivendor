<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserProfileUpdateRequest;
use App\Http\Requests\VendorUpdatePasswordRequest;

class UserController extends Controller
{
    public function dashboard()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('dashboard', compact('userData'));
    }

    // User profile update method
    public function update(UserProfileUpdateRequest $request)
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        if($request->hasFile('image')){
            if(File::exists(public_path('upload/user_images/'.$userData->image))){
                File::delete(public_path('upload/user_images/'.$userData->image));
            }
            $manager = new ImageManager(new Driver());
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = strtolower(str_replace(' ','_',$userData->name)).'.'.$extension;
            $imagePath = public_path('upload/user_images').'/'.$imageName;
            $make_img = $manager->read($request->file('image'));
            $make_img->save($imagePath);
    
            $userData->image = $imageName;
        }
        $userData->username    = $request->username;
        $userData->name        = $request->name;
        $userData->email       = $request->email;
        $userData->phone       = $request->phone;
        $userData->address     = $request->address;
        $userData->save();
        toastr()->success('User Profile updated successfully');
        return redirect()->back();
     
    }
    // User Logout
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }

    // User Password Update Method
    public function UserPasswordUpdate(VendorUpdatePasswordRequest $request)
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
}

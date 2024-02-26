<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserProfileUpdateRequest;

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
}

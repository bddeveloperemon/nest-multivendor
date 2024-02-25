<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\VendorProfileRequest;

class VendorController extends Controller
{
    //Vendor Dashboard Method
    public function VendorDashboard()
    {
        return view('backend.vendor.index');
    }

    public function vendorLogin(): View
    {
        return view('backend.vendor.login');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect('/vendor/login');
    }

    // Admin Profile Method
    public function vendorProfile(): view
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);
        return view('backend.vendor.profile',compact('vendorData'));
    }

    // Admin Profile Update Method
    public function vendorProfileStore(VendorProfileRequest $request): RedirectResponse
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);
        if($request->hasFile('image')){
            if(File::exists(public_path('upload/vendor_images/'.$vendorData->image))){
                File::delete(public_path('upload/vendor_images/'.$vendorData->image));
            }
            $manager = new ImageManager(new Driver());
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = strtolower(str_replace(' ','_',Auth::user()->name)).'.'.$extension;
            $imagePath = public_path('upload/vendor_images').'/'.$imageName;
            $make_img = $manager->read($request->file('image'));
            $make_img->save($imagePath);
    
            $vendorData->image = $imageName;
        }
        $vendorData->name              = $request->name;
        $vendorData->email             = $request->email;
        $vendorData->phone             = $request->phone;
        $vendorData->address           = $request->address;
        $vendorData->vendor_join       = $request->vendor_join;
        $vendorData->vendor_short_info = $request->vendor_short_info;
        $vendorData->save();
        toastr()->success('You data has been updated successfully');
        return redirect()->back();
    }
}

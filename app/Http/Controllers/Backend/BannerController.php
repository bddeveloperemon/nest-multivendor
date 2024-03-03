<?php

namespace App\Http\Controllers\Backend;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Http\Requests\BannerStoreRequest;
use Intervention\Image\Drivers\Gd\Driver;

class BannerController extends Controller
{
    public function allBanner()
    {
        $banners = Banner::select('id','banner_title','banner_url','banner_image')->latest()->get();
        return view('backend.banner.all_banners',compact('banners'));
    }

    public function addBanner()
    {
        return view('backend.banner.add_banner');
    }

    public function storeBanner(BannerStoreRequest $request)
    {
        if($request->hasFile('banner_image')){
            $manager = new ImageManager(new Driver());
            $extension = $request->file('banner_image')->getClientOriginalExtension();
            $imageName = time().'.'.$extension;
            $imagePath = public_path('upload/banner_images').'/'.$imageName;
            $make_img = $manager->read($request->file('banner_image'));
            $make_img->resize(768,450)->save($imagePath);
            
            Banner::insert([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
                'banner_image' => $imageName
            ]);
        }
        toastr()->success('New Banner Inserted Successfully');
        return redirect()->route('admin.all.banner');
    }

    public function editBanner($id)
    {
        $banner = Banner::find($id);
        return view('backend.banner.edit_banner',compact('banner'));
    }

    public function updateBanner(BannerStoreRequest $request, $id)
    {
        $banner = Banner::find($id);
        if($request->hasFile('banner_image')){
            if(File::exists(public_path('upload/banner_images/'.$banner->banner_image))){
                File::delete(public_path('upload/banner_images/'.$banner->banner_image));
            }
            $manager = new ImageManager(new Driver());
            $extension = $request->file('banner_image')->getClientOriginalExtension();
            $imageName = time().'.'.$extension;
            $imagePath = public_path('upload/banner_images').'/'.$imageName;
            $make_img = $manager->read($request->file('banner_image'));
            $make_img->resize(768,450)->save($imagePath);
            
            $banner->update([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
                'banner_image' => $imageName
            ]);
        }
        toastr()->success('Banner Updated Successfully');
        return redirect()->route('admin.all.banner');
    }

    public function deleteBanner($id)
    {
        $banner = Banner::find($id);
        if(File::exists(public_path('upload/banner_images/'.$banner->banner_image))){
            File::delete(public_path('upload/banner_images/'.$banner->banner_image));
        }
        $banner->delete();
        toastr()->success('Banner Deleted Successfully');
        return redirect()->route('admin.all.banner');
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use App\Http\Requests\BrandStoreRequest;
use Intervention\Image\Drivers\Gd\Driver;

class BrandController extends Controller
{
    public function allBrands()
    {
        $brands = Brand::select('id','brand_name','slug','image')->latest()->get();
        return view('backend.brand.all_brands',compact('brands'));
    }

    public function addBrand()
    {
        return view('backend.brand.add_brand');
    }

    public function brandStore(BrandStoreRequest $request)
    {
        if($request->hasFile('image')){
            $manager = new ImageManager(new Driver());
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = time().'.'.$extension;
            $imagePath = public_path('upload/brand_images').'/'.$imageName;
            $make_img = $manager->read($request->file('image'));
            $make_img->resize(300,300)->save($imagePath);
            
        }
        Brand::insert([
            'brand_name' => $request->brand_name,
            'slug' => strtolower(str_replace(' ','-',$request->brand_name)),
            'image' => $imageName
        ]);
        toastr()->success('New Brand Inserted Successfully');
        return redirect()->route('admin.all.brands');
    }
}

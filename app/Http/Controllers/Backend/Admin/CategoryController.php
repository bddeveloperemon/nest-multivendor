<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{
    public function allCategory()
    {
        $brands = Category::select('id','brand_name','slug','image')->latest()->get();
        return view('backend.brand.all_brands',compact('brands'));
    }

    public function addCategory()
    {
        return view('backend.brand.add_brand');
    }

    public function categoryStore(CategoryStoreRequest $request)
    {
        if($request->hasFile('image')){
            $manager = new ImageManager(new Driver());
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = time().'.'.$extension;
            $imagePath = public_path('upload/category_images').'/'.$imageName;
            $make_img = $manager->read($request->file('image'));
            $make_img->resize(300,300)->save($imagePath);
            
            Category::insert([
                'brand_name' => $request->brand_name,
                'slug' => strtolower(str_replace(' ','-',$request->brand_name)),
                'image' => $imageName
            ]);
        }else{
            Category::insert([
                'brand_name' => $request->brand_name,
                'slug' => strtolower(str_replace(' ','-',$request->brand_name))
            ]);
        }
        toastr()->success('New Brand Inserted Successfully');
        return redirect()->route('admin.all.brands');
    }

    public function editCategory($id)
    {
        $brand = Category::find($id);
        return view('backend.brand.edit_brand',compact('brand'));
    }

    public function updateCategory(Request $request, $id)
    {
        $brand = Category::find($id);
        if($request->hasFile('image')){
            if(File::exists(public_path('upload/category_images/'.$brand->image))){
                File::delete(public_path('upload/category_images/'.$brand->image));
            }
            $manager = new ImageManager(new Driver());
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = time().'.'.$extension;
            $imagePath = public_path('upload/category_images').'/'.$imageName;
            $make_img = $manager->read($request->file('image'));
            $make_img->resize(300,300)->save($imagePath);
            
            $brand->update([
                'brand_name' => $request->brand_name,
                'slug' => strtolower(str_replace(' ','-',$request->brand_name)),
                'image' => $imageName
            ]);
        }else{
            $brand->update([
                'brand_name' => $request->brand_name,
                'slug' => strtolower(str_replace(' ','-',$request->brand_name))
            ]);
        }
        toastr()->success('Brand Updated Successfully');
        return redirect()->route('admin.all.brands');
    }

    public function deleteCategory($id)
    {
        $brand = Category::find($id);
        if(File::exists(public_path('upload/category_images/'.$brand->image))){
            File::delete(public_path('upload/category_images/'.$brand->image));
        }
        $brand->delete();
        toastr()->success('Brand Deleted Successfully');
        return redirect()->route('admin.all.brands');
    }
}

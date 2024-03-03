<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function allSlider()
    {
        $sliders = Slider::select('id','slider_title','short_title','slider_image')->latest()->get();
        return view('backend.slider.all_sliders',compact('sliders'));
    }

    // public function addCategory()
    // {
    //     return view('backend.category.add_category');
    // }

    // public function categoryStore(CategoryStoreRequest $request)
    // {
    //     if($request->hasFile('category_image')){
    //         $manager = new ImageManager(new Driver());
    //         $extension = $request->file('category_image')->getClientOriginalExtension();
    //         $imageName = time().'.'.$extension;
    //         $imagePath = public_path('upload/category_images').'/'.$imageName;
    //         $make_img = $manager->read($request->file('category_image'));
    //         $make_img->resize(120,120)->save($imagePath);
            
    //         Category::insert([
    //             'category_name' => $request->category_name,
    //             'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
    //             'category_image' => $imageName
    //         ]);
    //     }else{
    //         Category::insert([
    //             'category_name' => $request->category_name,
    //             'category_slug' => strtolower(str_replace(' ','-',$request->category_name))
    //         ]);
    //     }
    //     toastr()->success('New Category Inserted Successfully');
    //     return redirect()->route('admin.all.categories');
    // }

    // public function editCategory($id)
    // {
    //     $category = Category::find($id);
    //     return view('backend.category.edit_category',compact('category'));
    // }

    // public function updateCategory(Request $request, $id)
    // {
    //     $category = Category::find($id);
    //     if($request->hasFile('category_image')){
    //         if(File::exists(public_path('upload/category_images/'.$category->category_image))){
    //             File::delete(public_path('upload/category_images/'.$category->category_image));
    //         }
    //         $manager = new ImageManager(new Driver());
    //         $extension = $request->file('category_image')->getClientOriginalExtension();
    //         $imageName = time().'.'.$extension;
    //         $imagePath = public_path('upload/category_images').'/'.$imageName;
    //         $make_img = $manager->read($request->file('category_image'));
    //         $make_img->resize(120,120)->save($imagePath);
            
    //         $category->update([
    //             'category_name' => $request->category_name,
    //             'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
    //             'category_image' => $imageName
    //         ]);
    //     }else{
    //         $category->update([
    //             'category_name' => $request->category_name,
    //             'category_slug' => strtolower(str_replace(' ','-',$request->category_name))
    //         ]);
    //     }
    //     toastr()->success('Category Updated Successfully');
    //     return redirect()->route('admin.all.categories');
    // }

    // public function deleteCategory($id)
    // {
    //     $category = Category::find($id);
    //     if(File::exists(public_path('upload/category_images/'.$category->category_image))){
    //         File::delete(public_path('upload/category_images/'.$category->category_image));
    //     }
    //     $category->delete();
    //     toastr()->success('Category Deleted Successfully');
    //     return redirect()->route('admin.all.categories');
    // }
}

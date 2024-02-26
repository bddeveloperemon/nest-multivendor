<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryStoreRequest;

class SubCategoryController extends Controller
{
    public function allSubCategory()
    {
        $sub_categories = SubCategory::with('category')->select('id','category_id','sub_category_name','sub_category_slug')->latest()->get();
        return view('backend.subcategory.all_subcategories',compact('sub_categories'));
    }

    public function addSubCategory()
    {
        $categories = Category::select('id','category_name')->orderBy('category_name','asc')->get();
        return view('backend.subcategory.add_subcategory',compact('categories'));
    }

    public function subcategoryStore(SubCategoryStoreRequest $request)
    {
        
        SubCategory::insert([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
            'sub_category_slug' => strtolower(str_replace(' ','-',$request->sub_category_name)),
        ]);
        toastr()->success('New Sub-Category Inserted Successfully');
        return redirect()->route('admin.all.subcategories');
    }

    public function editSubCategory($id)
    {
        $subcategory = SubCategory::find($id);
        $categories = Category::select('id','category_name')->orderBy('category_name','asc')->get();
        return view('backend.subcategory.edit_subcategory',compact('subcategory','categories'));
    }

    public function updateSubCategory(Request $request, $id)
    {
        $category = SubCategory::find($id);
        
            $category->update([
                'category_id' => $request->category_id,
                'sub_category_name' => $request->sub_category_name,
                'sub_category_slug' => strtolower(str_replace(' ','-',$request->sub_category_name)),
            ]);
        toastr()->success('Sub-Category Updated Successfully');
        return redirect()->route('admin.all.subcategories');
    }

    public function deleteSubCategory($id)
    {
        $subcategory = SubCategory::find($id);
        $subcategory->delete();
        toastr()->success('Sub-Category Deleted Successfully');
        return redirect()->route('admin.all.subcategories');
    }
}

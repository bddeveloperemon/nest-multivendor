<?php

namespace App\Http\Controllers\Backend\Admin;

use Carbon\Carbon;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    // All Blog Category
    public function allBlogCategory()
    {
        $blogCategories = BlogCategory::latest()->get();
        return view('backend.blog.category.all_blog_categories',compact('blogCategories'));
    }

    // Add Blog Category
    public function addBlogCategory()
    {
        return view('backend.blog.category.add_blog_category');
    }

    // Store Blog Category
    public function storeBlogCategory(Request $request)
    {
        BlogCategory::insert([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ','-',$request->blog_category_name)),
            'created_at' => Carbon::now()
        ]);
        toastr()->success('New Blog Category Inserted Successfully');
        return redirect()->route('admin.blog.category');
    }

    // Edit Blog Category
    public function editBlogCategory($id)
    {
        $blogCategories = BlogCategory::find($id);
        return view('backend.blog.category.edit_blog_category',compact('blogCategories'));
    }

    // Update Blog Category
    public function updateBlogCategory(Request $request, $id)
    {
        $blogCategories = BlogCategory::find($id);
        $blogCategories->update([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ','-',$request->blog_category_name)),
            'updated_at' => Carbon::now()
        ]);
        toastr()->success('Blog Category Updated Successfully');
        return redirect()->route('admin.blog.category');
    }

    // Delete Blog Category
    public function deleteBlogCategory($id)
    {
        BlogCategory::find($id)->delete();
        toastr()->success('Category Deleted Successfully');
        return redirect()->back();
    }
}

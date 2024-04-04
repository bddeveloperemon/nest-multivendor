<?php

namespace App\Http\Controllers\Backend\Admin;

use Carbon\Carbon;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Http\Requests\BlogPostRequest;
use Intervention\Image\Drivers\Gd\Driver;

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

    // All Blog Post
    public function allBlogPost()
    {
        $blogPosts = BlogPost::with('category')->select('id','category_id','post_title','post_image')->latest()->get();
        return view('backend.blog.post.all_blogPost',compact('blogPosts'));
    }

    public function addBlogPost()
    {
        $blogCategories = BlogCategory::select('id','blog_category_name')->latest()->get();
        return view('backend.blog.post.add_blogPost',compact('blogCategories'));
    }

    public function storeBlogPost(BlogPostRequest $request)
    {
        if($request->hasFile('post_image')){
            $manager = new ImageManager(new Driver());
            $extension = $request->file('post_image')->getClientOriginalExtension();
            $imageName = time().'.'.$extension;
            $imagePath = public_path('upload/blog/').$imageName;
            $make_img = $manager->read($request->file('post_image'));
            $make_img->resize(1103,906)->save($imagePath);
            
            BlogPost::insert([
                'category_id' => $request->category_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ','-',$request->post_slug)),
                'post_short_description' => $request->post_short_description,
                'post_long_description' => $request->post_long_description,
                'post_image' => $imageName,
                'created_at' => Carbon::now(),
            ]);
        }
        toastr()->success('Blog Post Inserted Successfully');
        return redirect()->route('admin.blog.post');
    }

    public function editBlogPost($id)
    {
        $blogCategories = BlogCategory::select('id','blog_category_name')->latest()->get();
        $blogPost = BlogPost::find($id);
        return view('backend.blog.post.edit_blogPost',compact('blogPost','blogCategories'));
    }

    public function updateBlogPost(BlogPostRequest $request, $id)
    {
        $blogCategory = BlogPost::find($id);
        if($request->hasFile('post_image')){
            if(File::exists(public_path('upload/blog/'.$blogCategory->post_image))){
                File::delete(public_path('upload/blog/'.$blogCategory->post_image));
            }
            $manager = new ImageManager(new Driver());
            $extension = $request->file('post_image')->getClientOriginalExtension();
            $imageName = time().'.'.$extension;
            $imagePath = public_path('upload/blog').'/'.$imageName;
            $make_img = $manager->read($request->file('post_image'));
            $make_img->resize(1103,906)->save($imagePath);
            
            $blogCategory->update([
                'category_id' => $request->category_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ','-',$request->post_slug)),
                'post_short_description' => $request->post_short_description,
                'post_long_description' => $request->post_long_description,
                'post_image' => $imageName,
                'updated_at' => Carbon::now(),
            ]);
        }else{
            $blogCategory->update([
                'category_id' => $request->category_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ','-',$request->post_slug)),
                'post_short_description' => $request->post_short_description,
                'post_long_description' => $request->post_long_description,
                'updated_at' => Carbon::now(),
            ]);
        }
        toastr()->success('Blog Post Updated Successfully');
        return redirect()->route('admin.blog.post');
    }

    public function deleteBlogPost($id)
    {
        $blogCategory = BlogPost::find($id);
        if(File::exists(public_path('upload/blog/'.$blogCategory->post_image))){
            File::delete(public_path('upload/blog/'.$blogCategory->post_image));
        }
        $blogCategory->delete();
        toastr()->success('Blog Post Deleted Successfully');
        return redirect()->route('admin.blog.post');
    }
}

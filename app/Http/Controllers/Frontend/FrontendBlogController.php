<?php

namespace App\Http\Controllers\Frontend;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;

class FrontendBlogController extends Controller
{
    // Show Blog Posts
    public function allBlog()
    {
        $blogCategories = BlogCategory::latest()->get();
        $blogPosts = BlogPost::latest()->paginate(5);
        return view('frontend.blog.home_blog',compact('blogCategories', 'blogPosts'));
    }

    // Blog Post Details
    public function blogPostDetails($id,$slug)
    {
        $blogCategories = BlogCategory::latest()->get();
        $blogDetails = BlogPost::findOrFail($id);
        $breadCat = BlogCategory::where('id',$id)->get();
        return view('frontend.blog.blog_post_details',compact('blogCategories', 'blogDetails','breadCat'));
    }

    // Blog Category Details
    public function blogPostCategory($id,$slug)
    {
        $blogCategories = BlogCategory::latest()->get();
        $blogPosts = BlogPost::where('category_id',$id)->get();
        $breadCat = BlogCategory::where('id',$id)->get();
        return view('frontend.blog.blog_category_post',compact('blogCategories', 'blogPosts','breadCat'));
    }
}

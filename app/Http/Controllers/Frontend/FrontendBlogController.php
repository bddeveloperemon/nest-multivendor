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
        $blogPosts = BlogPost::latest()->get();
        return view('frontend.blog.home_blog',compact('blogCategories', 'blogPosts'));
    }

    // Blog Post Details
    public function blogPostDetails($id,$post_slug)
    {
        $blogCategories = BlogCategory::latest()->get();
        $blogDetails = BlogPost::findOrFail($id);
        $breadCat = BlogCategory::where('id',$id)->get();
        return view('frontend.blog.blog_post_details',compact('blogCategories', 'blogDetails','breadCat'));
    }
}

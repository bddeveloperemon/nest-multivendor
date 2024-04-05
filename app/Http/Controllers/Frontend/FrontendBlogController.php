<?php

namespace App\Http\Controllers\Frontend;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;

class FrontendBlogController extends Controller
{
    public function allBlog()
    {
        $blogCategories = BlogCategory::select('blog_category_name')->latest()->get();
        $blogPosts = BlogPost::latest()->get();
        return view('frontend.blog.home_blog',compact('blogCategories', 'blogPosts'));
    }
}

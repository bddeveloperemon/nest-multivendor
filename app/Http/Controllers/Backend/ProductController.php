<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    // Product List Method
    public function allProducts(): View
    {
        $products = Product::latest()->get();
        return view('backend.product.all-products', compact('products'));
    }

    // Add Product Method
    public function addProduct(): View
    {
        $activeVendors = User::where(['status' => 'active','role'=> 'vendor'])->latest()->get();
        $brands = Brand::select('id','brand_name')->get();
        $categories = Category::select('id','category_name')->get();
        return view('backend.product.add-product', compact('brands','categories','activeVendors'));
    }
}

<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VendorProductController extends Controller
{
    // Vendor Product List Method
    public function vendorProductList(): View
    {
        $id = Auth::user()->id;
        $products = Product::where('vendor_id',$id)->latest()->get();
        return view('backend.vendor.product.vendor-product-list',compact('products'));
    }

    // Vendor Add Product Method
    public function vendorAddProduct(): View
    {
        $brands = Brand::select('id','brand_name')->get();
        $categories = Category::select('id','category_name')->get();
        return view('backend.vendor.product.vendor-add-product', compact('brands','categories'));
    }
}

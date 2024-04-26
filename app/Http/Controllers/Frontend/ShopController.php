<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class ShopController extends Controller
{
    // Shop Page
    public function shop()
    {
        $products = Product::query();
        $categories = Category::orderBy('category_name', 'asc')->get();
        $brands = Brand::orderBy('brand_name', 'asc')->get();
        $newProduct = Product::orderBy('id', 'desc')->limit(3)->get();
        
        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $catIds = Category::select('id')->whereIn('category_slug', $slugs)->pluck('id')->toArray();
            $products->whereIn('category_id', $catIds);
        } elseif (!empty($_GET['brand'])) {
            $slugs = explode(',', $_GET['brand']);
            $brandIds = Brand::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            $products->whereIn('brand_id', $brandIds);
        }else {
            $products->where('status', 1);
        }

        $products = $products->orderBy('id', 'desc')->get();

        return view('frontend.product.shop', compact('categories', 'products', 'newProduct','brands'));
    }


    // Shop Filter
    public function shopFilter(Request $request)
    {
        $data = $request->all();
        // Filter For Category  
        $catUrl = "";
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catUrl)) {
                    $catUrl .= "&category=" . $category;
                }else {
                    $catUrl .= ",". $category;
                }
            }
        } 
        // Filter For Brand  
        $brandUrl = "";
        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
                if (empty($brandUrl)) {
                    $brandUrl .= "&brand=" . $brand;
                }else {
                    $brandUrl .= ",". $brand;
                }
            }
        } 
        return redirect()->route('shop',$catUrl.$brandUrl);
    }
}

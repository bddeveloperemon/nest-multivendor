<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    // Shop Page
    public function shop()
    {
        $products = Product::query();
        $categories = Category::orderBy('category_name', 'asc')->get();
        $newProduct = Product::orderBy('id', 'desc')->limit(3)->get();

        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $catIds = Category::select('id')->whereIn('category_slug', $slugs)->pluck('id')->toArray();
            $products->whereIn('category_id', $catIds);
        } else {
            $products->where('status', 1);
        }

        $products = $products->orderBy('id', 'desc')->get();

        return view('frontend.product.shop', compact('categories', 'products', 'newProduct'));
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
        return redirect()->route('shop',$catUrl);
    }
}

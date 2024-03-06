<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function productDetails($id,$slug)
    {
        $product = Product::findOrFail($id);
        $product_color = explode(',',$product->product_color);
        $product_size = explode(',',$product->product_size);
        return view('frontend.product.product_details',compact('product','product_color','product_size'));
    }
}

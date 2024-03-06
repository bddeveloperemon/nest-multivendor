<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MultiImg;

class IndexController extends Controller
{
    public function productDetails($id,$slug)
    {
        $product = Product::findOrFail($id);
        $multi_imgs = MultiImg::where('product_id',$id)->get();
        $product_color = explode(',',$product->product_color);
        $product_size = explode(',',$product->product_size);
        return view('frontend.product.product_details',compact('product','product_color','product_size','multi_imgs'));
    }
}

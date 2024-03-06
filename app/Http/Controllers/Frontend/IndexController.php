<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $skip_category_5 = Category::skip(5)->first();
        $skip_product_5 = Product::where(['status'=>1,'category_id'=>$skip_category_5->id])->orderBy('id','desc')->limit(5)->get();
        return view('frontend.index',compact('skip_category_5','skip_product_5'));
    }
    public function productDetails($id,$slug)
    {
        $product = Product::findOrFail($id);
        $multi_imgs = MultiImg::where('product_id',$id)->get();
        $product_color = explode(',',$product->product_color);
        $product_size = explode(',',$product->product_size);
        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','desc')->limit(4)->get();
        return view('frontend.product.product_details',compact('product','product_color','product_size','multi_imgs','relatedProduct'));
    }
}

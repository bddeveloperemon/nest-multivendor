<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProductController extends Controller
{
    // Product List Method
    public function allProducts(): View
    {
        $products = Product::latest()->get();
        return view('backend.product.all-products', compact('products'));
    }
}

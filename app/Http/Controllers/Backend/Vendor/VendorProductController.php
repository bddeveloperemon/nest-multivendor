<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VendorProductController extends Controller
{
    public function vendorProductList()
    {
        $id = Auth::user()->id;
        $products = Product::where('vendor_id',$id)->latest()->get();
        return view('backend.vendor.vendor-product-list',compact('products'));
    }
}

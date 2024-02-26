<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function allBrands()
    {
        $brands = Brand::select('id','brand_name','slug','image')->latest()->get();
        return view('backend.brand.all_brands',compact('brands'));
    }

    public function addBrand()
    {
        return view('backend.brand.add_brand');
    }
}

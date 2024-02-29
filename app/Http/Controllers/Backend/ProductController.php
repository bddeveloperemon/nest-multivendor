<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use Illuminate\View\View;
use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Drivers\Gd\Driver;

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

    // Product Store Method
    public function storeProduct(ProductRequest $request): RedirectResponse 
    {
        $manager   = new ImageManager(new Driver());
        $extension = $request->file('product_thambnail')->getClientOriginalExtension();
        $imageName = hexdec(uniqid()).'.'.$extension;
        $imagePath = public_path('upload/product_images/thambnail').'/'.$imageName;
        $make_img  = $manager->read($request->file('product_thambnail'));
        $make_img->resize(800,800)->save($imagePath);

        $product = Product::insertGetId([
            'brand_id'          => $request->brand_id,
            'category_id'      => $request->category_id,
            'subcategory_id'   => $request->subcategory_id,
            'product_name'      => $request->product_name,
            'product_slug'      => strtolower(str_replace(' ','-',$request->product_name)),
            'product_code'      => $request->product_code,
            'product_qty'       => $request->product_qty,
            'product_tags'      => $request->product_tags,
            'product_size'      => $request->product_size,
            'product_color'     => $request->product_color,
            'selling_price'     => $request->selling_price,
            'discount_price'    => $request->discount_price,
            'short_desc'        => $request->short_desc,
            'long_desc'         => $request->long_desc,
            'product_thambnail' => $imageName,
            'vendor_id'         => $request->vendor_id,
            'hot_deals'         => $request->hot_deals,
            'featured'          => $request->featured,
            'special_offer'     => $request->special_offer,
            'special_deals'     => $request->special_deals,
            'status'            => 1,
            'created_at'        => Carbon::now(),
        ]);
        $multi_imgs = $request->file('multi_img');
        foreach($multi_imgs as $img){
            $manager   = new ImageManager(new Driver());
            $extension = $img->getClientOriginalExtension();
            $imageName = hexdec(uniqid()).'.'.$extension;
            $imagePath = public_path('upload/product_images/multi_imgs').'/'.$imageName;
            $make_img  = $manager->read($img);
            $make_img->resize(800,800)->save($imagePath);

            MultiImg::insert([
                'product_id' => $product,
                'image_name' => $imageName,
                'created_at' => Carbon::now(),
            ]);
        }   

        toastr()->success('Product added successfully');
        return redirect()->route('admin.all.products');
    }

    // Edit Product Method
    public function editProduct($id): View
    {
        $activeVendors = User::where(['status' => 'active','role'=> 'vendor'])->latest()->get();
        $product = Product::findOrFail($id);
        $brands = Brand::select('id','brand_name')->get();
        $categories = Category::select('id','category_name')->get();
        $subcategories = SubCategory::select('id','sub_category_name')->get();
        return view('backend.product.edit-product', compact('brands','categories','product','activeVendors','subcategories'));
    }

    // Update Product Method
    public function updateProduct(ProductRequest $request, $id): RedirectResponse
    {
        $product = Product::findOrFail($id)->update([
            'brand_id'          => $request->brand_id,
            'category_id'      => $request->category_id,
            'subcategory_id'   => $request->subcategory_id,
            'product_name'      => $request->product_name,
            'product_slug'      => strtolower(str_replace(' ','-',$request->product_name)),
            'product_code'      => $request->product_code,
            'product_qty'       => $request->product_qty,
            'product_tags'      => $request->product_tags,
            'product_size'      => $request->product_size,
            'product_color'     => $request->product_color,
            'selling_price'     => $request->selling_price,
            'discount_price'    => $request->discount_price,
            'short_desc'        => $request->short_desc,
            'long_desc'         => $request->long_desc,
            'vendor_id'         => $request->vendor_id,
            'hot_deals'         => $request->hot_deals,
            'featured'          => $request->featured,
            'special_offer'     => $request->special_offer,
            'special_deals'     => $request->special_deals,
            'status'            => 1,
            'updated_at'        => Carbon::now(),
        ]);
        toastr()->success('Product updated successfully');
        return redirect()->route('admin.all.products');
    }
}

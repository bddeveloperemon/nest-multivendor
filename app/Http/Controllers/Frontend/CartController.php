<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Cupon;
use App\Models\Product;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    // product add to cart
    public function addToCart(Request $request, $id)
    {        
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $product = Product::findOrFail($id);
        if($product->discount_price == NULL)
        {
            Cart::add([
                'id'      => $id,
                'name'    => $request->product_name,
                'qty'     => $request->qty,
                'price'   => $product->selling_price,
                'weight'  => 1,
                'options' => [
                    'image'     => $product->product_thambnail,
                    'color'     => $request->color,
                    'size'      => $request->size,
                    'vendor_id' => $request->vendor_id,
                ],
            ]);
            
            return response()->json(['success'=> 'Product Added On Your Cart']);
        }else{
            Cart::add([
                'id'      => $id,
                'name'    => $request->product_name,
                'qty'     => $request->qty,
                'price'   => $product->discount_price,
                'weight'  => 1,
                'options' => [
                    'image'     => $product->product_thambnail,
                    'color'     => $request->color,
                    'size'      => $request->size,
                    'vendor_id' => $request->vendor_id,
                ],
            ]);
            
            return response()->json(['success'=> 'Product Added On Your Cart']);
        }
    }

    // product add to cart
    public function addToCartDetails(Request $request, $id)
    {        
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $product = Product::findOrFail($id);
        if($product->discount_price == NULL)
        {
            Cart::add([
                'id'      => $id,
                'name'    => $request->product_name,
                'qty'     => $request->qty,
                'price'   => $product->selling_price,
                'weight'  => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size'  => $request->size,
                    'vendor'  => $request->vendor
                ],
            ]);
            
            return response()->json(['success'=> 'Product Added On Your Cart']);
        }else{
            Cart::add([
                'id'      => $id,
                'name'    => $request->product_name,
                'qty'     => $request->qty,
                'price'   => $product->discount_price,
                'weight'  => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size'  => $request->size,
                    'vendor'  => $request->vendor
                ],
            ]);
            
            return response()->json(['success'=> 'Product Added On Your Cart']);
        }
    }


    // product mini cart
    public function addMiniCart()
    {
        $carts = Cart::content();
        $cartqty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'carts'     => $carts,
            'cartqty'   => $cartqty,
            'cartTotal' => $cartTotal
        ]);
    }

    // minicart product remove
    public function miniCartProductRemove($id)
    {
        Cart::remove($id);
        return response()->json(['success' => 'Product Remove From Cart Successfully']);
    }

    // My Cart Function
    public function myCart()
    {
        $products = Cart::count();
        return view('frontend.mycart.view_cart',compact('products'));
    }

    // get cart product function 
    public function myCartProduct()
    {
        $carts = Cart::content();
        $cartqty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'carts' => $carts,
            'cartqty' => $cartqty,
            'cartTotal' => $cartTotal
        ]);
    }


    // view page cart product remove 
    public function myCartRemove($id)
    {
        Cart::remove($id);
        if (Session::has('coupon')) {
            $coupon_name    = Session::get('coupon')['cupon_name'];
            $coupon         = Cupon::where('cupon_name',$coupon_name)->first();
            $carttotal      = Cart::total();
            $carttotal      = str_replace(['$', ','], '', $carttotal);
            $cupon_discount = (int)$coupon->cupon_discount;
            Session::put('coupon', [
                'cupon_name'      => $coupon->cupon_name,
                'cupon_discount'  => $cupon_discount,
                'discount_amount' => round($carttotal * $cupon_discount / 100),
                'total_amount'    => round($carttotal - $carttotal * $cupon_discount / 100),
            ]);
        }
        return response()->json(['success' => 'Product Remove Successfully']);
    }

    // view page cart decrement
    public function cartDecrement($id)
    {
        $row = Cart::get($id);
        Cart::update($id, $row->qty-1);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['cupon_name'];
            $coupon = Cupon::where('cupon_name',$coupon_name)->first();
            $carttotal = Cart::total(); 
            $carttotal = str_replace(['$', ','], '', $carttotal);
            $cupon_discount = (int)$coupon->cupon_discount;
            Session::put('coupon', [
                'cupon_name' => $coupon->cupon_name,
                'cupon_discount' => $cupon_discount,
                'discount_amount' => round($carttotal * $cupon_discount / 100),
                'total_amount' => round($carttotal - $carttotal * $cupon_discount / 100),
            ]);
        }
        return response()->json('Decrement');
    }

    // view page cart decrement
    public function cartIncrement($id)
    {
        $row = Cart::get($id);
        Cart::update($id, $row->qty+1);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['cupon_name'];
            $coupon = Cupon::where('cupon_name',$coupon_name)->first();
            $carttotal = Cart::total(); 
            $carttotal = str_replace(['$', ','], '', $carttotal);
            $cupon_discount = (int)$coupon->cupon_discount;
            Session::put('coupon', [
                'cupon_name' => $coupon->cupon_name,
                'cupon_discount' => $cupon_discount,
                'discount_amount' => round($carttotal * $cupon_discount / 100),
                'total_amount' => round($carttotal - $carttotal * $cupon_discount / 100),
            ]);
        }
        return response()->json('Increment');
    }

    // Apply Coupon 
    public function couponApply(Request $request)
    {
        $coupon = Cupon::where('cupon_name',$request->cupon_name)->where('cupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if($coupon){
            $carttotal      = Cart::total();
            $carttotal      = str_replace(['$', ','], '', $carttotal);
            $cupon_discount = (int)$coupon->cupon_discount;
            Session::put('coupon', [
                'cupon_name'      => $coupon->cupon_name,
                'cupon_discount'  => $cupon_discount,
                'discount_amount' => round($carttotal * $cupon_discount / 100),
                'total_amount'    => round($carttotal - $carttotal * $cupon_discount / 100),
            ]);
            return response()->json([
                'validity'=> true,
                'success' => 'Coupon Applied Successfully'
            ]);
        }else{
            return response()->json(['error' => 'Invalid Coupon']);
        }

    }

    // Coupon Calculation 
    public function couponCalculate()
    {
        $carttotal = Cart::total(); 
        $carttotal = str_replace(['$', ','], '', $carttotal);

        if (Session::has('coupon')) {
            
            return response()->json([
                'subtotal'        => $carttotal,
                'cupon_name'      => session()->get('coupon')['cupon_name'],
                'cupon_discount'  => session()->get('coupon')['cupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount'    => session()->get('coupon')['total_amount'],
            ]);
        }else{
            return response()->json([
                'total' => $carttotal
            ]);
        }
    }


    // Coupon Remove
    public function removeCoupon()
    {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    }


    // checkout
    public function checkout()
    {
        if(Auth::check()){
            if (Cart::total() > 0) {
                $carts     = Cart::content();
                $cartqty   = Cart::count();
                $cartTotal = Cart::total();
                $cartTotal = str_replace(['$', ','], '', $cartTotal);
                $divisions = ShipDivision::orderBy('division_name','asc')->get();

                return view('frontend.checkout.checkout',compact('carts','cartqty','cartTotal','divisions'));
            }else{
                toastr()->error('Shopping At List One Product!');
                return redirect()->to('/');
            }
        }else{
            toastr()->error('You need to Login first!');
            return redirect()->route('login');
        }
    }
}

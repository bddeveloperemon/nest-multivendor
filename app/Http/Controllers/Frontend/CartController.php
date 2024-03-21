<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // product add to cart
    public function addToCart(Request $request, $id)
    {        
        $product = Product::findOrFail($id);
        if($product->discount_price == NULL)
        {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->qty,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color'=> $request->color,
                    'size'=> $request->size,
                ],
            ]);
            
            return response()->json(['success'=> 'Product Added On Your Cart']);
        }else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->qty,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color'=> $request->color,
                    'size'=> $request->size,
                ],
            ]);
            
            return response()->json(['success'=> 'Product Added On Your Cart']);
        }
    }

    // product add to cart
    public function addToCartDetails(Request $request, $id)
    {        
        $product = Product::findOrFail($id);
        if($product->discount_price == NULL)
        {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->qty,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color'=> $request->color,
                    'size'=> $request->size,
                ],
            ]);
            
            return response()->json(['success'=> 'Product Added On Your Cart']);
        }else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->qty,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color'=> $request->color,
                    'size'=> $request->size,
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
            'carts' => $carts,
            'cartqty' => $cartqty,
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
        return view('frontend.mycart.view_cart');
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
        return response()->json(['success' => 'Product Remove Successfully']);
    }
}

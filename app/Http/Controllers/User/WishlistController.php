<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request, $product_id)
    {
        if(Auth::check()){
            $exists = Wishlist::where(['user_id'=> Auth::id(),'product_id'=>$product_id])->first();
            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now()
                ]);
                return response()->json(['success' => 'Product Added to Wishlist']);
            }else{
                return response()->json(['error' => 'This product has already been exist on your wishlist!']);
            }
        }else{
            return response()->json(['error' => 'At first you want to login your account']);
        }
    }
}

<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Compare;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    public function addToCompare(Request $request, $product_id)
    {
        if(Auth::check()){
            $exists = Compare::where(['user_id'=> Auth::id(),'product_id'=>$product_id])->first();
            if (!$exists) {
                Compare::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now()
                ]);
                return response()->json(['success' => 'Product Added to Compare']);
            }else{
                return response()->json(['error' => 'This product has already been exist on your Compare!']);
            }
        }else{
            return response()->json(['error' => 'At first login your account']);
        }
    }

    public function allCompare()
    {
        $compare = Compare::with('product')->where('user_id',Auth::id())->get();
        return view('frontend.compare.view_compare',compact('compare'));
        
    }

    public function compareProduct()
    {
        $compare = Compare::with('product')->where('user_id',Auth::id())->latest()->get();
        $compareQty = $compare->count();
        return response()->json([
            'compare' => $compare, 
            'compareQty' => $compareQty, 
        ]);
    }

    public function compareRemove($id)
    {
        Compare::where(['user_id'=>Auth::id(),'id'=>$id])->delete();
        return response()->json([
            'success' => 'Compare Product Delete Successfully'
        ]);
    }
}

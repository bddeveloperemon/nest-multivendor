<?php

namespace App\Http\Controllers\User;

use App\Models\ShipState;
use App\Models\ShipDistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    // district dependencies method
    public function getDistrict($division_id)
    {
        $district_name = ShipDistrict::where('division_id',$division_id)->orderBy('district_name','asc')->get();
        return response()->json($district_name);
    }

    // state dependencies method
    public function getState($district_id)
    {
        $state_name = ShipState::where('district_id',$district_id)->orderBy('state_name','asc')->get();
        return response()->json($state_name);
    }

    //checkout store
    public function storeCheckout(Request $request)
    {
        $data = [];
        $data['shipping_name']    = $request->shipping_name;
        $data['shipping_email']   = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone']   = $request->shipping_phone;
        $data['division_id']      = $request->division_id;
        $data['district_id']      = $request->district_id;
        $data['state_id']         = $request->state_id;
        $data['post_code']        = $request->post_code;
        $data['notes']            = $request->notes;

        $cartTotal = Cart::total(); 
        $cartTotal = str_replace(['$', ','], '', $cartTotal);

        if ($request->payment_option == 'stripe') {
            return view('frontend.payment.stripe',compact('data','cartTotal'));
        } else if ($request->payment_option == 'card') {
            return 'Card Page';
        }else{
            return view('frontend.payment.cash_on_delivery',compact('data','cartTotal'));
        }
        
    }
}

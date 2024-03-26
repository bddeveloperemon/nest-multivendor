<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class StripeController extends Controller
{
    public function stripeOrder(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount      = Cart::total();
            $total_amount      = str_replace(['$', ','], '', $total_amount);
        }
        \Stripe\Stripe::setApiKey('sk_test_51OyAJBFpVzIhUfRoxacYaFVPn8gqkRXgGW6Kb16LIgXnFFjTOrn9dyA62uJCyzD1ftjKfxGShCDVGFd8MYpa1Zeg00ajs4aTC1');
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
            'amount'      => $total_amount*100,
            'currency'    => 'usd',
            'description' => 'Nest Multivendor Shop',
            'source'      => $token,
            'metadata'    => ['order_id' => uniqid()],
        ]);

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => $charge->payment_method,
            'payment_method' => "Stripe",
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,

            'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d m Y'),
            'order_month' => Carbon::now()->format('M'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' =>  Carbon::now(),
        ]);
        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vendor_id' => $cart->options->vendor,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'price' => $cart->price,
                'qty' => $cart->qty,
                'created_at' =>  Carbon::now(),
            ]);
        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        Cart::destroy();
        toastr()->success('Your Order Place Successfully');
        return redirect()->route('dashboard');
    }
}

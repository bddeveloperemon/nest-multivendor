<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function stripeOrder(Request $request)
    {
        \Stripe\Stripe::setApiKey('sk_test_51OyAJBFpVzIhUfRoxacYaFVPn8gqkRXgGW6Kb16LIgXnFFjTOrn9dyA62uJCyzD1ftjKfxGShCDVGFd8MYpa1Zeg00ajs4aTC1');
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
        'amount' => 999*100,
        'currency' => 'usd',
        'description' => 'Nest Multivendor Shop',
        'source' => $token,
        'metadata' => ['order_id' => '6735'],
        ]);

        dd($charge);
    }
}

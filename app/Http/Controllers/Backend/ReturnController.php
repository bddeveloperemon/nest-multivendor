<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReturnController extends Controller
{
    public function returnRequest()
    {
        $orders = Order::where('return_order',1)->orderBy('id','desc')->get();
        return view('backend.return_order.return_request',compact('orders'));
    }
}

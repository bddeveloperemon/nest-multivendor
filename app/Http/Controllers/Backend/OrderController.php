<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function pendingOrder()
    {
        $orders = Order::where('status','pending')->orderBy('id','desc')->get();
        return view('backend.order.pending_order',compact('orders'));
    }
}

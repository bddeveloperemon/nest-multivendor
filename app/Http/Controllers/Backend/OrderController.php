<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
   // pending orders
    public function pendingOrder()
    {
        $orders = Order::where('status','pending')->orderBy('id','desc')->get();
        return view('backend.order.pending_order',compact('orders'));
    }

   // confirm orders
    public function confirmedOrder()
    {
        $orders = Order::where('status','confirm')->orderBy('id','desc')->get();
        return view('backend.order.confirm_orders',compact('orders'));
    }

   // processing orders
    public function processingOrder()
    {
        $orders = Order::where('status','processing')->orderBy('id','desc')->get();
        return view('backend.order.processing_orders',compact('orders'));
    }

   // deliverded orders
    public function deliverdedOrder()
    {
        $orders = Order::where('status','deliverd')->orderBy('id','desc')->get();
        return view('backend.order.deliverded_orders',compact('orders'));
    }

    // Pending Order Details
    public function adminOrderDetails($id)
    {
        $order = Order::with('division','district','state','user')->whereId($id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $id)->orderBy('id','desc')->get();
        return view('backend.order.order_details',compact('order','orderItem'));  
    }
}

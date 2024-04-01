<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{
    // Show vendor order
    public function vendorOrder()
    {
        $id = Auth::user()->id;
        $orderItems = OrderItem::with('order')->where('vendor_id',$id)->orderBy('id','desc')->get();
        return view('backend.vendor.order.pending_order',compact('orderItems'));
    }

    // return vendor order
    public function vendorReturnOrder()
    {
        $id = Auth::user()->id;
        $orderItems = OrderItem::with('order')->where('vendor_id',$id)->orderBy('id','desc')->get();
        return view('backend.vendor.order.return_order',compact('orderItems'));
    }

    // complete vendor return order
    public function vendorCompleteReturnOrder()
    {
        $id = Auth::user()->id;
        $orderItems = OrderItem::with('order')->where('vendor_id',$id)->orderBy('id','desc')->get();
        return view('backend.vendor.order.complete_return_order',compact('orderItems'));
    }

    // return order details
    public function vendorOrderDetails($id)
    {
        $order = Order::with('division','district','state','user')->whereId($id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $id)->orderBy('id','desc')->get();
        return view('backend.vendor.order.order_details',compact('order','orderItem'));
    }
}

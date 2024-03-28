<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AllUserController extends Controller
{
    // User Account Details page
    public function userAccount(){
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.userdashboard.account_details',compact('userData'));
    }

    // User Change Password page
    public function userChangePassword()
    {
        return view('frontend.userdashboard.change_password');

    }

    // User orders page
    public function userOrder()
    {
        $id = Auth::user()->id;
        $orders = Order::where('user_id', $id)->orderBy('id','desc')->get();
        return view('frontend.userdashboard.order_details',compact('orders'));

    }

    // User Order Details
    public function userOrderDetails($order_id)
    {
        $order = Order::with('division','district','state','user')->where((['id'=> $order_id, 'user_id'=> Auth::id()]))->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id','desc')->get();
        return view('frontend.order.order_details',compact('order','orderItem'));   
    }
}

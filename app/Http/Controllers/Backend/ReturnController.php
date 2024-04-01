<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReturnController extends Controller
{
   // Return Request Show
    public function returnRequest()
    {
        $orders = Order::where('return_order',1)->orderBy('id','desc')->get();
        return view('backend.return_order.return_request',compact('orders'));
    }

    // Approve Return request
    public function returnApprove($id)
    {
        Order::where('id',$id)->update([
            'return_order' => 2
        ]);

        toastr()->success('Return Order Successfully');
        return redirect()->back();
    }
}

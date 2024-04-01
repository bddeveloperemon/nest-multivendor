<?php

namespace App\Http\Controllers\Backend\Admin;

use DateTime;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    // View Report
    public function reportView()
    {
        return view('backend.report.view_report');
    }

    // search by date
    public function searchByDate(Request $request)
    {
        $date = New DateTime($request->date);
        $formatDate = $date->format('d M Y');
        $orders = Order::where('order_date',$formatDate)->latest()->get();
        return view('backend.report.report_by_date',compact('orders','formatDate'));
    }
}

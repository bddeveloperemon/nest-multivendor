<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    //Vendor Dashboard Method
    public function VendorDashboard()
    {
        return view('backend.vendor.dashboard');
    }
}

<?php

namespace App\Http\Controllers\Backend\Vendor;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class VendorController extends Controller
{
    //Vendor Dashboard Method
    public function VendorDashboard()
    {
        return view('backend.vendor.index');
    }

    public function vendorLogin(): View
    {
        return view('backend.vendor.login');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect('/vendor/login');
    }
}

<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    //Admin Dashboard Method
    public function AdminDashboard(): View
    {
        return view('backend.admin.index');
    }

    //Admin Login Page
    public function adminLogin(): View
    {
        return view('backend.admin.login');
    }

    // Admin Logout Method

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}

<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //Admin Dashboard Method
    public function AdminDashboard()
    {
        return view('backend.admin.dashboard');
    }
}

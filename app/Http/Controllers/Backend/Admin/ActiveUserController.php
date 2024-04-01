<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiveUserController extends Controller
{
   // Read all register users
    public function allUser()
    {
        $users = User::where('role','user')->latest()->get();
        return view('backend.user.user_data', compact('users'));
    }

   // Read all register vendors
    public function allVendor()
    {
        $vendors = User::where('role','vendor')->latest()->get();
        return view('backend.user.vendor_data', compact('vendors'));
    }
}

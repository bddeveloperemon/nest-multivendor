<?php

namespace App\Http\Controllers\User;

use App\Models\User;
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
        return view('frontend.userdashboard.order_details');

    }
}

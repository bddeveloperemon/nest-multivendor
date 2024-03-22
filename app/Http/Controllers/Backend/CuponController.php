<?php

namespace App\Http\Controllers\Backend;

use App\Models\Cupon;
use Illuminate\Http\Request;
use App\Http\Requests\CuponRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class CuponController extends Controller
{
    public function allCupon()
    {
        $cupons = Cupon::latest()->get();
        return view('backend.cupon.cupon-list', compact('cupons'));
    }

    public function addCupon()
    {
        return view('backend.cupon.add_coupon');
    }

    public function storeCoupon(CuponRequest $request){
        Cupon::insert([
            'cupon_name' => $request->cupon_name,
            'cupon_discount' => $request->cupon_discount,
            'cupon_validity' => $request->cupon_validity,
            'created_at' => Carbon::now(),
        ]);
        toastr()->success('New Coupon Inserted Successfully');
        return redirect()->route('admin.all.cupon');
    }
}

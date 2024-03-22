<?php

namespace App\Http\Controllers\Backend;

use App\Models\Cupon;
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

    public function editCoupon($id)
    {
        $cupon = Cupon::find($id);
        return view('backend.cupon.edit_coupon',compact('cupon'));
    }

    public function updateCoupon(CuponRequest $request, $id)
    {
        $cupon = Cupon::find($id);
            $cupon->update([
                'cupon_name' => $request->cupon_name,
                'cupon_discount' => $request->cupon_discount,
                'cupon_validity' => $request->cupon_validity,
                'updated_at' => Carbon::now()
            ]);
        toastr()->success('Coupon Updated Successfully');
        return redirect()->route('admin.all.cupon');
    }

    public function deleteCoupon($id)
    {
        $cupon = Cupon::find($id);
        $cupon->delete();
        toastr()->success('Coupon Deleted Successfully');
        return redirect()->route('admin.all.cupon');
    }
}

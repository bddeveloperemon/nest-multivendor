<?php

namespace App\Http\Controllers\Backend;

use App\Models\Cupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CuponController extends Controller
{
    public function allCupon()
    {
        $cupons = Cupon::all();
        return view('backend.cupon.cupon-list', compact('cupons'));
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Models\ShipState;
use App\Models\ShipDistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    // district dependencies method
    public function getDistrict($division_id)
    {
        $district_name = ShipDistrict::where('division_id',$division_id)->orderBy('district_name','asc')->get();
        return response()->json($district_name);
    }

    // statre dependencies method
    public function getState($district_id)
    {
        $state_name = ShipState::where('district_id',$district_id)->orderBy('state_name','asc')->get();
        return response()->json($state_name);
    }
}

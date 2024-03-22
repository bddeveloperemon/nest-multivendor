<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingAreaController extends Controller
{
    //Ship Division method start here
    public function allDivision()
    {
        $divisions = ShipDivision::latest()->get();
        return view('backend.ship.division.division-list', compact('divisions'));
    }

    public function addDivision()
    {
        return view('backend.ship.division.add_division');
    }

    public function storeDivision(Request $request){
        $request->validate([
            'division_name' => 'required|unique:ship_divisions|string|max:255',
        ]);
        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);
        toastr()->success('Ship Division Inserted Successfully');
        return redirect()->route('admin.all.division');
    }

    public function editDivision($id)
    {
        $division = ShipDivision::find($id);
        return view('backend.ship.division.edit_division',compact('division'));
    }

    public function updateDivision(Request $request, $id)
    {
        $request->validate([
            'division_name' => 'required|string|max:255',
        ]);
        $ShipDivision = ShipDivision::find($id);
            $ShipDivision->update([
                'division_name' => $request->division_name,
                'updated_at' => Carbon::now()
            ]);
        toastr()->success('Division Updated Successfully');
        return redirect()->route('admin.all.division');
    }

    public function deleteDivision($id)
    {
        $ShipDivision = ShipDivision::find($id);
        $ShipDivision->delete();
        toastr()->success('Division Deleted Successfully');
        return redirect()->route('admin.all.division');
    }

    //Ship Division method end here
}

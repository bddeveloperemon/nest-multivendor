<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\ShipState;
use App\Models\ShipDistrict;
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

    //Ship District method start here
    public function allDistrict()
    {
        $districts = ShipDistrict::with('division')->latest()->get();
        return view('backend.ship.district.district-list', compact('districts'));
    }

    public function addDistrict()
    {
        $divisions = ShipDivision::select('id','division_name')->orderBy('division_name','asc')->get();
        return view('backend.ship.district.add_district',compact('divisions'));
    }

    public function storeDistrict(Request $request)
    {
        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);
        toastr()->success('Ship District Inserted Successfully');
        return redirect()->route('admin.all.district');
    }

    public function editDistrict($id)
    {
        $district = ShipDistrict::find($id);
        $divisions = ShipDivision::select('id','division_name')->orderBy('division_name','asc')->get();
        return view('backend.ship.district.edit_district',compact('district','divisions'));
    }

    public function updateDistrict(Request $request, $id)
    {
        $district = ShipDistrict::find($id);
        
            $district->update([
                'division_id' => $request->division_id,
                'district_name' => $request->district_name,
                'updated_at' => Carbon::now()
            ]);
        toastr()->success('District Updated Successfully');
        return redirect()->route('admin.all.district');
    }

    public function deleteDistrict($id)
    {
        $district = ShipDistrict::find($id);
        $district->delete();
        toastr()->success('Ship District Deleted Successfully');
        return redirect()->route('admin.all.district');
    }
    //Ship District method end here

    //Ship state method start here
    public function allState()
    {
        $states = ShipState::with(['division','district'])->latest()->get();
        return view('backend.ship.state.state-list', compact('states'));
    }

    public function addState()
    {
        $divisions = ShipDivision::select('id','division_name')->orderBy('division_name','asc')->get();
        $districts = ShipDistrict::select('id','district_name')->orderBy('district_name','asc')->get();
        return view('backend.ship.state.add_state',compact('divisions','districts'));
    }

    public function storeState(Request $request)
    {
        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
        ]);
        toastr()->success('Ship State Inserted Successfully');
        return redirect()->route('admin.all.state');
    }

    public function editState($id)
    {
        $state = ShipState::find($id);
        $divisions = ShipDivision::select('id','division_name')->orderBy('division_name','asc')->get();
        $districts = ShipDistrict::select('id','district_name')->orderBy('district_name','asc')->get();
        return view('backend.ship.state.edit_state',compact('state','divisions','districts'));
    }

    public function updateState(Request $request, $id)
    {
        $district = ShipState::find($id);
        
            $district->update([
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'state_name' => $request->state_name,
                'updated_at' => Carbon::now()
            ]);
        toastr()->success('State Updated Successfully');
        return redirect()->route('admin.all.state');
    }

    public function deleteState($id)
    {
        $state = ShipState::find($id);
        $state->delete();
        toastr()->success('Ship State Deleted Successfully');
        return redirect()->route('admin.all.state');
    }

    // state dependencies method
    public function getDistrict($division_id)
    {
        $district_name = ShipDistrict::where('division_id',$division_id)->orderBy('district_name','asc')->get();
        return response()->json($district_name);
    }
    //Ship state method end here
}

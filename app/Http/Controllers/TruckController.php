<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TruckController extends Controller
{
    // Index: show all trucks
    public function index() {
        $trucks = Truck::all()->sortBy('license_plate');
        return view('admin.truck.index', compact('trucks'));
    }

    // Create: show the form to create new truck
    public function create() {
        return view('admin.truck.create');
    }

    // Store: when user submit the form to create new truck
    public function store(Request $request) {
        // Validate the form
        $request->validate([
            'license_plate' => 'required',
            'brand' => 'required',
            'production_year' => 'required',
            'last_maintenance' => 'required',
            'state_type' => 'required|in:good,bad',
            'state_evidence' => 'required_if:state_type,bad|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Create new State
        $state = new State;
        $state->type = $request->state_type;
        if ($request->hasFile('state_evidence')) {
            $path = $request->file('state_evidence')->store('evidences', 'public');
            $state->evidence = 'storage/' . $path;
        }
        $state->save();

        // // Create new truck
        $truck = new Truck;
        $truck->license_plate = $request->license_plate;
        $truck->brand = $request->brand;
        $truck->production_year = $request->production_year;
        $truck->last_maintenance = $request->last_maintenance;
        $truck->state_id = $state->id;
        $truck->save();

        // Redirect to truck index
        return redirect()->route('truck.index');
    }

    // Edit: show the form to edit truck
    public function edit($id) {
        $truck = Truck::find($id);
        return view('admin.truck.edit', compact('truck'));
    }

    // Update: when user submit the form to edit truck
    public function update(Request $request, $id) {
        // Validate the form
        $request->validate([
            'license_plate' => 'required',
            'brand' => 'required',
            'production_year' => 'required',
            'last_maintenance' => 'required',
            'state_type' => 'required|in:good,bad',
            'state_evidence' => 'required_if:state_type,bad|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find truck and state
        $truck = Truck::find($id);
        $state = State::find($truck->state_id);

        // Update truck
        $truck->license_plate = $request->license_plate;
        $truck->brand = $request->brand;
        $truck->production_year = $request->production_year;
        $truck->last_maintenance = $request->last_maintenance;
        $truck->save();

        // Update state
        $state->type = $request->state_type;
        if ($request->hasFile('state_evidence')) {
            if ($state->evidence) {
                Storage::delete($state->evidence);
            }
            $path = $request->file('state_evidence')->store('evidences', 'public');
            $state->evidence = 'storage/' . $path;
        }
        $state->save();

        // Redirect to truck index
        return redirect()->route('truck.index');
    }

    // Delete: when user want to delete truck
    public function delete($id) {
        // Find truck and state
        $truck = Truck::find($id);
        $state = State::find($truck->state_id);

        // Delete truck
        $truck->delete();

        // Delete state
        if ($state->evidence) {
            Storage::delete($state->evidence);
        }
        $state->delete();

        // Redirect to truck index
        return redirect()->route('truck.index');
    }
}

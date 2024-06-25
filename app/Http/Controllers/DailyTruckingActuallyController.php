<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DailyTruckingActually;
use App\Models\DailyTruckingPlan;
use App\Models\Destination;
use App\Models\Shipment;
use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DailyTruckingActuallyController extends Controller
{
    // Index: show all daily trucking actually
    public function index()
    {
        $shipments = Shipment::latest()->get();
        return view('admin.dta.index', compact('shipments'));
    }

    // Show: show detail daily trucking actually
    public function show($shipment)
    {
        $shipment = Shipment::findOrfail($shipment);
        $dtas = DailyTruckingActually::where('shipment_id', $shipment->id)->get()->sortBy('truck.license_plate');
        return view('admin.dta.show', compact('shipment', 'dtas'));
    }

    // Edit: show form edit daily trucking actually
    public function edit($shipment, $id)
    {
        // Get data
        $dta = DailyTruckingActually::findOrFail($id);
        $shipment = Shipment::findOrfail($shipment);
        $selected = DailyTruckingPlan::where('id', $dta->daily_trucking_plan_id)->first();
        $trucks = Truck::whereHas('state', function ($query) {
            $query->where('type', 'good');
        })->get()->sortBy('license_plate');

        // Check if shipment has been billed
        if ($shipment->bill_id) {
            return redirect()->route('dta.show', $shipment->id)->with('error', 'You can\'t edit this daily trucking actually because this shipment has been billed.');
        } else {
            return view('admin.dta.edit', compact('dta', 'shipment', 'selected', 'trucks'));
        }
    }

    // Update: update daily trucking actually
    public function update(Request $request, $shipment, $id)
    {
        // Validate the form
        $request->validate([
            'driver_name' => 'required',
            'size' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        // If truck is not vendor truck, validate truck_id
        if ($request->truck_id) {
            $request->validate([
                'truck_id' => 'required|exists:trucks,id',
            ]);
        }

        // Get shipment from database
        $shipment = Shipment::findOrFail($shipment);
        if ($shipment->bill_id) {
            return redirect()->route('dtp.show', $shipment->id)->with('error', 'Bill already created, cannot edit daily trucking actually.');
        }

        // Find daily trucking actually
        $dta = DailyTruckingActually::findOrFail($id);

        // Update daily trucking actually
        $dta->driver_name = $request->driver_name;
        $dta->size = $request->size;
        $dta->price = $request->price;
        $dta->is_vendor_truck = $request->truck_id ? false : true;
        $dta->truck_id = $request->truck_id;

        // Update destination 1
        if ($dta->destination_1_id != null) {
            $destination1 = Destination::find($dta->destination_1_id);
            $destination1->detail = $request->destination_1_detail;
            if ($request->hasFile('destination_1_image')) {
                if ($destination1->image != null) {
                    Storage::delete(str_replace('storage', 'public', $destination1->image));
                }
                $path = $request->file('destination_1_image')->store('destinations', 'public');
                $destination1->image = 'storage/' . $path;
            }
            $destination1->save();
        } else {
            if ($request->destination_1_detail != '') {
                $destination1 = new Destination;
                $destination1->type = 1;
                $destination1->detail = $request->destination_1_detail;
                if ($request->hasFile('destination_1_image')) {
                    $path = $request->file('destination_1_image')->store('destinations', 'public');
                    $destination1->image = 'storage/' . $path;
                }
                $destination1->save();
                $dta->destination_1_id = $destination1->id;
            }
        }

        // Update destination 2
        if ($dta->destination_2_id != null) {
            $destination2 = Destination::find($dta->destination_2_id);
            $destination2->detail = $request->destination_2_detail;
            if ($request->hasFile('destination_2_image')) {
                if ($destination2->image != null) {
                    Storage::delete(str_replace('storage', 'public', $destination2->image));
                }
                $path = $request->file('destination_2_image')->store('destinations', 'public');
                $destination2->image = 'storage/' . $path;
            }
            $destination2->save();
        } else {
            if ($request->destination_2_detail != '') {
                $destination2 = new Destination;
                $destination2->type = 2;
                $destination2->detail = $request->destination_2_detail;
                if ($request->hasFile('destination_2_image')) {
                    $path = $request->file('destination_2_image')->store('destinations', 'public');
                    $destination2->image = 'storage/' . $path;
                }
                $destination2->save();
                $dta->destination_2_id = $destination2->id;
            }
        }

        // Update destination 3
        if ($dta->destination_3_id != null) {
            $destination3 = Destination::find($dta->destination_3_id);
            $destination3->detail = $request->destination_3_detail;
            if ($request->hasFile('destination_3_image')) {
                if ($destination3->image != null) {
                    Storage::delete(str_replace('storage', 'public', $destination3->image));
                }
                $path = $request->file('destination_3_image')->store('destinations', 'public');
                $destination3->image = 'storage/' . $path;
            }
            $destination3->save();
        } else {
            if ($request->destination_3_detail != '') {
                $destination3 = new Destination;
                $destination3->type = 3;
                $destination3->detail = $request->destination_3_detail;
                if ($request->hasFile('destination_3_image')) {
                    $path = $request->file('destination_3_image')->store('destinations', 'public');
                    $destination3->image = 'storage/' . $path;
                }
                $destination3->save();
                $dta->destination_3_id = $destination3->id;
            }
        }

        // Save daily trucking actually
        $dta->save();

        // Redirect to index
        return redirect()->route('dta.show', $shipment->id)->with('success', 'Daily trucking actually has been updated');
    }

    // Download: download client file
    public function downloadClientFile($file)
    {
        return response()->download($file);
    }
}

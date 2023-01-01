<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DailyTruckingPlan;
use App\Models\Destination;
use App\Models\Shipment;
use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DailyTruckingPlanController extends Controller
{
    // Index: show all daily trucking plans
    public function index()
    {
        $dtps = DailyTruckingPlan::all()->sortBy('date');
        return view('admin.dtp.index', compact('dtps'));
    }

    public function truck()
    {
        $dtps = DailyTruckingPlan::all()->sortBy('date');
        return view('admin.dtp.truck', compact('dtps'));
    }

    public function show()
    {
        $dtps = DailyTruckingPlan::all()->sortBy('date');
        return view('admin.dtp.show', compact('dtps'));
    }

    // Create: show the form to create new daily trucking plan
    public function create()
    {
        $clients = Client::all();
        $trucks = Truck::whereHas('state', function ($query) {
            $query->where('type', 'good');
        })->get()->sortBy('license_plate');
        return view('admin.dtp.create', compact('clients', 'trucks'));
    }

    // Store: store new daily trucking plan to database
    public function store(Request $request)
    {
        // Validate the form
        $request->validate([
            'price' => 'required|numeric',
            'order_type' => 'required|in:export,import',
            'client_id' => 'required|exists:clients,id',
            'truck_id' => 'required|exists:trucks,id',
        ]);

        // Create new shipment
        $shipment = new Shipment;
        if ($request->destination_1_detail == '' && $request->destination_2_detail == '' && $request->destination_3_detail == '') {
            $shipment->status = 'pending';
        } else {
            $shipment->status = 'on-the-way';
        }
        $shipment->save();

        // Create new daily trucking plan
        $dtp = new DailyTruckingPlan;
        $dtp->shipment_id = $shipment->id;
        $dtp->price = $request->price;
        $dtp->order_type = $request->order_type;
        $dtp->client_id = $request->client_id;
        $dtp->truck_id = $request->truck_id;

        // Create new destination 1
        if ($request->destination_1_detail != '') {
            $destination1 = new Destination;
            $destination1->type = 1;
            $destination1->detail = $request->destination_1_detail;
            if ($request->hasFile('destination_1_image')) {
                $path = $request->file('destination_1_image')->store('destinations', 'public');
                $destination1->image = 'storage/' . $path;
            }
            $destination1->save();
            $dtp->destination_1_id = $destination1->id;
        }

        // Create new destination 2
        if ($request->destination_2_detail != '') {
            $destination2 = new Destination;
            $destination2->type = 2;
            $destination2->detail = $request->destination_2_detail;
            if ($request->hasFile('destination_2_image')) {
                $path = $request->file('destination_2_image')->store('destinations', 'public');
                $destination2->image = 'storage/' . $path;
            }
            $destination2->save();
            $dtp->destination_2_id = $destination2->id;
        }

        // Create new destination 3
        if ($request->destination_3_detail != '') {
            $destination3 = new Destination;
            $destination3->type = 3;
            $destination3->detail = $request->destination_3_detail;
            if ($request->hasFile('destination_3_image')) {
                $path = $request->file('destination_3_image')->store('destinations', 'public');
                $destination3->image = 'storage/' . $path;
            }
            $destination3->save();
            $dtp->destination_3_id = $destination3->id;
        }

        // Save the daily trucking plan
        $dtp->save();

        // Redirect to the daily trucking plan index page
        return redirect()->route('dtp.index')->with('success', 'Daily trucking plan created successfully!');
    }

    // Edit: show the form to edit daily trucking plan
    public function edit($id)
    {
        $dtp = DailyTruckingPlan::find($id);
        $clients = Client::all();
        $trucks = Truck::whereHas('state', function ($query) {
            $query->where('type', 'good');
        })->get()->sortBy('license_plate');
        return view('admin.dtp.edit', compact('dtp', 'clients', 'trucks'));
    }

    // Update: update daily trucking plan to database
    public function update(Request $request, $id)
    {
        // Validate the form
        $request->validate([
            'price' => 'required|numeric',
            'order_type' => 'required|in:export,import',
            'client_id' => 'required|exists:clients,id',
            'truck_id' => 'required|exists:trucks,id',
        ]);

        // Find daily trucking plan, shipment, and destinations
        $dtp = DailyTruckingPlan::find($id);
        $shipment = Shipment::find($dtp->shipment_id);

        // Update shipment
        if ($request->destination_1_detail == '' && $request->destination_2_detail == '' && $request->destination_3_detail == '') {
            $shipment->status = 'pending';
        } else {
            $shipment->status = 'on-the-way';
        }
        $shipment->save();

        // Update daily trucking plan
        $dtp->price = $request->price;
        $dtp->order_type = $request->order_type;
        $dtp->client_id = $request->client_id;
        $dtp->truck_id = $request->truck_id;

        // Update destination 1
        if ($dtp->destination_1_id != null) {
            $destination1 = Destination::find($dtp->destination_1_id);
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
                $dtp->destination_1_id = $destination1->id;
            }
        }

        // Update destination 2
        if ($dtp->destination_2_id != null) {
            $destination2 = Destination::find($dtp->destination_2_id);
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
                $dtp->destination_2_id = $destination2->id;
            }
        }

        // Update destination 3
        if ($dtp->destination_3_id != null) {
            $destination3 = Destination::find($dtp->destination_3_id);
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
                $dtp->destination_3_id = $destination3->id;
            }
        }

        // Save daily trucking plan
        $dtp->save();

        // Redirect to daily trucking plan index
        return redirect()->route('dtp.index')->with('success', 'Daily trucking plan updated successfully');
    }

    // Delete: delete daily trucking plan from database
    public function delete($id)
    {
        // Find daily trucking plan, shipment, and destinations
        $dtp = DailyTruckingPlan::find($id);
        $shipment = Shipment::find($dtp->shipment_id);
        $destination1 = Destination::find($dtp->destination_1_id);
        $destination2 = Destination::find($dtp->destination_2_id);
        $destination3 = Destination::find($dtp->destination_3_id);

        // Delete daily trucking plan
        $dtp->delete();

        // Delete shipment
        $shipment->delete();

        // Delete destinations
        if ($destination1 != null) {
            if ($destination1->image != null) {
                Storage::delete(str_replace('storage', 'public', $destination1->image));
            }
            $destination1->delete();
        }
        if ($destination2 != null) {
            if ($destination2->image != null) {
                Storage::delete(str_replace('storage', 'public', $destination2->image));
            }
            $destination2->delete();
        }
        if ($destination3 != null) {
            if ($destination3->image != null) {
                Storage::delete(str_replace('storage', 'public', $destination3->image));
            }
            $destination3->delete();
        }

        // Redirect to the daily trucking plan index page
        return redirect()->route('dtp.index')->with('success', 'Daily trucking plan deleted successfully');
    }
}

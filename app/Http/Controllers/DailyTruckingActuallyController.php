<?php

namespace App\Http\Controllers;

use App\Models\DailyTruckingActually;
use App\Models\DailyTruckingPlan;
use App\Models\Destination;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DailyTruckingActuallyController extends Controller
{
    // Index: show all daily trucking actually
    public function index()
    {
        // latest dta
        $dtas = DailyTruckingActually::latest()->get();
        return view('admin.dta.index', compact('dtas'));
    }

    // Create: show form create daily trucking actually
    public function create(Request $request)
    {
        $dtps = DailyTruckingPlan::doesntHave('dailyTruckingActually')->orderBy('shipment_id')->get();
        if (isset($request->DTA)) {
            $selected = DailyTruckingPlan::where('id', $request->DTA)->first();
        } else {
            $selected = null;
        }
        return view('admin.dta.create', compact('dtps', 'selected'));
    }

    // Store: store daily trucking actually
    public function store(Request $request)
    {
        // Validate the form
        $request->validate([
            'daily_trucking_plan_id' => 'required|exists:daily_trucking_plans,id',
            'price' => 'required|numeric',
            'renban' => 'required',
            'container_size' => 'required',
        ]);

        // Update Shipments
        $dtp = DailyTruckingPlan::find($request->daily_trucking_plan_id);
        $shipment = Shipment::find($dtp->shipment_id);
        if ($request->destination_1_detail != '' && $request->destination_2_detail != '' && $request->destination_3_detail != '') {
            $shipment->status = "delivered";
        } else {
            $shipment->status = "on-the-way";
        }
        $shipment->save();

        // Create new daily trucking actually
        $dta = new DailyTruckingActually;
        $dta->daily_trucking_plan_id = $request->daily_trucking_plan_id;
        $dta->price = $request->price;
        $dta->renban = $request->renban;
        $dta->container_size = $request->container_size;

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
            $dta->destination_1_id = $destination1->id;
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
            $dta->destination_2_id = $destination2->id;
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
            $dta->destination_3_id = $destination3->id;
        }

        // Save daily trucking actually
        $dta->save();

        // Redirect to index
        return redirect()->route('dta.index')->with('success', 'Daily Trucking Actually created successfully.');
    }

    // Edit: show form edit daily trucking actually
    public function edit(Request $request, $id)
    {
        // Find daily trucking actually
        $dta = DailyTruckingActually::find($id);

        $dtps = DailyTruckingPlan::doesntHave('dailyTruckingActually')->orderBy('shipment_id')->get();
        $dtps->push(DailyTruckingPlan::find($dta->daily_trucking_plan_id));
        $dtps = $dtps->sortBy('shipment_id');

        if (isset($request->DTA)) {
            $selected = DailyTruckingPlan::where('id', $request->DTA)->first();
        } else {
            $selected = null;
        }
        // dd($request->DTA);
        return view('admin.dta.edit', compact('dta', 'dtps', 'selected'));
    }

    // Update: update daily trucking actually
    public function update(Request $request, $id)
    {
        // Validate the form
        $request->validate([
            'daily_trucking_plan_id' => 'required|exists:daily_trucking_plans,id',
            'price' => 'required|numeric',
            'renban' => 'required',
            'container_size' => 'required',
        ]);

        // Find daily trucking actually and destinations
        $dta = DailyTruckingActually::find($id);
        $destination1 = Destination::find($dta->destination_1_id);
        $destination2 = Destination::find($dta->destination_2_id);
        $destination3 = Destination::find($dta->destination_3_id);

        // Update Shipments
        $shipment = Shipment::find($dta->dailyTruckingPlan->shipment_id);
        if ($request->destination_1_detail != '' && $request->destination_2_detail != '' && $request->destination_3_detail != '') {
            $shipment->status = "delivered";
        } else {
            $shipment->status = "on-the-way";
        }
        $shipment->save();

        // Update daily trucking actually
        $dta->daily_trucking_plan_id = $request->daily_trucking_plan_id;
        $dta->price = $request->price;
        $dta->renban = $request->renban;
        $dta->container_size = $request->container_size;

        // Update destination 1
        if ($request->destination_1_detail != '') {
            if ($destination1 == null) {
                $destination1 = new Destination();
                $destination1->type = 1;
            }
            $destination1->detail = $request->destination_1_detail;
            if ($request->hasFile('destination_1_image')) {
                if ($destination1->image != null) {
                    Storage::delete(str_replace('storage', 'public', $destination1->image));
                }
                $path = $request->file('destination_1_image')->store('destinations', 'public');
                $destination1->image = 'storage/' . $path;
            }
            $destination1->save();
            $dta->destination_1_id = $destination1->id;
        } else {
            if ($destination1 != null) {
                if ($destination1->image != null) {
                    Storage::delete(str_replace('storage', 'public', $destination1->image));
                }
                $destination1->delete();
            }
            $dta->destination_1_id = null;
        }

        // Update destination 2
        if ($request->destination_2_detail != '') {
            if ($destination2 == null) {
                $destination2 = new Destination();
                $destination2->type = 2;
            }
            $destination2->detail = $request->destination_2_detail;
            if ($request->hasFile('destination_2_image')) {
                if ($destination2->image != null) {
                    Storage::delete(str_replace('storage', 'public', $destination2->image));
                }
                $path = $request->file('destination_2_image')->store('destinations', 'public');
                $destination2->image = 'storage/' . $path;
            }
            $destination2->save();
            $dta->destination_2_id = $destination2->id;
        } else {
            if ($destination2 != null) {
                if ($destination2->image != null) {
                    Storage::delete(str_replace('storage', 'public', $destination2->image));
                }
                $destination2->delete();
            }
            $dta->destination_2_id = null;
        }

        // Update destination 3
        if ($request->destination_3_detail != '') {
            if ($destination3 == null) {
                $destination3 = new Destination();
                $destination3->type = 3;
            }
            $destination3->detail = $request->destination_3_detail;
            if ($request->hasFile('destination_3_image')) {
                if ($destination3->image != null) {
                    Storage::delete(str_replace('storage', 'public', $destination3->image));
                }
                $path = $request->file('destination_3_image')->store('destinations', 'public');
                $destination3->image = 'storage/' . $path;
            }
            $destination3->save();
            $dta->destination_3_id = $destination3->id;
        } else {
            if ($destination3 != null) {
                if ($destination3->image != null) {
                    Storage::delete(str_replace('storage', 'public', $destination3->image));
                }
                $destination3->delete();
            }
            $dta->destination_3_id = null;
        }

        // Save daily trucking actually
        $dta->save();

        // Redirect to index
        return redirect()->route('dta.index')->with('success', 'Daily Trucking Actually updated successfully.');
    }

    // Delete: delete daily trucking actually
    public function delete($id)
    {
        // Find daily trucking actually and destinations
        $dta = DailyTruckingActually::find($id);
        $destination1 = Destination::find($dta->destination_1_id);
        $destination2 = Destination::find($dta->destination_2_id);
        $destination3 = Destination::find($dta->destination_3_id);

        // Delete daily trucking actually
        $dta->delete();

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

        // Redirect to index
        return redirect()->route('dta.index')->with('success', 'Daily Trucking Actually deleted successfully.');
    }
}

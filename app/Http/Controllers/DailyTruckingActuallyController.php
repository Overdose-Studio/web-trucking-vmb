<?php

namespace App\Http\Controllers;

use App\Enums\LogType;
use App\Http\Services\LogService;
use App\Models\DailyTruckingActually;
use App\Models\DailyTruckingPlan;
use App\Models\Destination;
use App\Models\Shipment;
use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DailyTruckingActuallyController extends Controller
{
    /**
     * DailyTruckingActuallyController constructor.
     *
     * Initializes the service with the provided LogService instance.
     *
     * @param LogService $service The LogService instance.
     */
    public function __construct(private LogService $log) {}

    // Index: show all daily trucking actually
    public function index()
    {
        $shipments = Shipment::latest()->get();
        return view('admin.dta.index', compact('shipments'));
    }

    // Show: show detail daily trucking actually
    public function show(Shipment $shipment)
    {
        // Get data
        $dtas = DailyTruckingActually::where('shipment_id', $shipment->id)
                ->get()
                ->sortBy('truck.license_plate');

        // Return view
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
            'price' => 'required|numeric',
            'destination_3_detail' => 'required|string',
        ]);

        // Get shipment from database
        $shipment = Shipment::findOrFail($shipment);
        if ($shipment->bill_id) {
            return redirect()->route('dta.show', $shipment->id)->with('error', 'Bill already created, cannot edit daily trucking actually.');
        }

        // Find daily trucking actually
        $dta = DailyTruckingActually::findOrFail($id);

        // Update daily trucking actually
        $dta->price = $request->price;

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

    // Approving: change state on shipment
    public function approving(Shipment $shipment)
    {
        // Update shipment status
        $shipment->status = 'Approving DTA';
        $shipment->save();

        // Create log
        $this->log->create(
            shipment: $shipment,
            type: LogType::SET_DTA
        );

        // Redirect to index
        return redirect()->route('dta.show', $shipment->id)->with('success', 'Sending approving DTA to Operation');
    }

    // Approval Index: List of approval DTA by Operation
    public function approval_index()
    {
        $shipments = Shipment::latest()->get();
        return view('admin.dta.approval.index', compact('shipments'));
    }

    // Approval Show: Display DTA by Operation
    public function approval_show(Shipment $shipment)
    {
        // Get Data
        $dtas = DailyTruckingActually::where('shipment_id', $shipment->id)
                ->get()
                ->sortBy('truck.license_plate');

        // Show the approval show page
        return view('admin.dta.approval.show', compact('dtas', 'shipment'));
    }

    // Approval Truck: Display Truck by Operation
    public function approval_truck(Shipment $shipment, DailyTruckingActually $dta)
    {
        // Get data
        $selected = DailyTruckingPlan::where('id', $dta->daily_trucking_plan_id)->first();
        $trucks = Truck::whereHas('state', fn($query) => $query->where('type', 'good'))
                    ->get()
                    ->sortBy('license_plate');

        // Return view
        return view('admin.dta.approval.truck', compact('dta', 'shipment', 'selected', 'trucks'));
    }

    // Approval Set: Approve DTA by Operation edit
    public function approval_set(Shipment $shipment)
    {
        // Update Shipment Status
        $shipment->status = 'Waiting Bill';
        $shipment->save();

        // Create log
        $this->log->create(
            shipment: $shipment,
            type: LogType::APPROVE_DTA
        );

        // Redirect to index
        return redirect()->route('dta.approval.index', $shipment->id)->with('success', 'Success approving DTA for ' . $shipment->client->name . '.');
    }

    // Approval Edit: Show the form to edit DTA by Operation
    public function approval_edit(Shipment $shipment, DailyTruckingActually $dta)
    {
        // Check if bill is already created
        if ($shipment->bill_id) {
            return redirect()->route('dta.approval.show', $shipment->id)
                             ->with('error', 'Bill already created, cannot update truck on DTA ' . $shipment->client->name);
        }

        // Get Data
        $trucks = Truck::whereHas('state', fn($query) => $query->where('type', 'good'))
                       ->get()
                       ->sortBy('license_plate');
        $selected = DailyTruckingPlan::where('id', $dta->daily_trucking_plan_id)->first();

        // Return view
        return view('admin.dta.approval.edit', compact('dta', 'shipment', 'selected', 'trucks'));
    }

    // Approval Update: Update DTA by Operation
    public function approval_update(Request $request, Shipment $shipment, DailyTruckingActually $dta)
    {
        // Validate the form
        $request->validate([
            'price' => 'required|numeric',
            'destination_3_detail' => 'required|string',
        ]);

        // Check if bill is already created
        if ($shipment->bill_id) {
            return redirect()->route('dta.approval.show', $shipment->id)
                             ->with('error', 'Bill already created, cannot update truck on DTA ' . $shipment->client->name);
        }

        // Update daily trucking actually
        // $dta->driver_name = $request->driver_name;
        $dta->price = $request->price;

        // Update destinations
        $this->updateDestination($dta, 'destination_1', $request);
        $this->updateDestination($dta, 'destination_2', $request);
        $this->updateDestination($dta, 'destination_3', $request);

        // Save daily trucking actually
        $dta->save();

        // Redirect to index
        return redirect()->route('dta.approval.show', $shipment->id)->with('success', 'Daily trucking actually has been updated');
    }

    // Download: download client file
    public function downloadClientFile($file)
    {
        return response()->download($file);
    }

    // Update Destination: Function to update destination
    private function updateDestination(DailyTruckingActually $dta, $destinationField, Request $request)
    {
        // Set destination fields
        $destinationIdField = $destinationField . '_id';
        $destinationDetailField = $destinationField . '_detail';
        $destinationImageField = $destinationField . '_image';

        // Check if destination exists
        $destination = $dta->$destinationIdField ? Destination::find($dta->$destinationIdField) : new Destination;

        // Set destination details
        $destination->detail = $request->$destinationDetailField;

        // Handle image upload
        if ($request->hasFile($destinationImageField)) {
            if ($destination->image) {
                Storage::delete(str_replace('storage', 'public', $destination->image));
            }
            $path = $request->file($destinationImageField)->store('destinations', 'public');
            $destination->image = 'storage/' . $path;
        }

        // Save new destination if it doesn't exist
        if (!$dta->$destinationIdField && $request->$destinationDetailField) {
            $destination->type = substr($destinationField, -1);
            $destination->save();
            $dta->$destinationIdField = $destination->id;
        }

        // Save updated destination details
        if ($dta->$destinationIdField) {
            $destination->save();
        }
    }
}

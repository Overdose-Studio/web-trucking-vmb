<?php

namespace App\Http\Controllers;

use App\Enums\LogType;
use App\Http\Services\LogService;
use App\Models\Client;
use App\Models\DailyTruckingPlan;
use App\Models\DailyTruckingActually;
use App\Models\Destination;
use App\Models\Driver;
use App\Models\Shipment;
use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DailyTruckingPlanController extends Controller
{
    /**
     * DailyTruckingPlanController constructor.
     *
     * Initializes the service with the provided LogService instance.
     *
     * @param LogService $service The LogService instance.
     */
    public function __construct(private LogService $log) {}

    // Index: show all daily trucking plans
    public function index()
    {
        $shipments = Shipment::latest()->get();
        return view('admin.dtp.index', compact('shipments'));
    }

    // Show: show all trucks in a shipment
    public function show(Shipment $shipment)
    {
        // Get Data
        $dtps = DailyTruckingPlan::where('shipment_id', $shipment->id)
                ->get()
                ->sortBy('truck.license_plate');

        // Show the daily trucking plan show page
        return view('admin.dtp.show', compact('dtps', 'shipment'));
    }

    // Approving: change state on shipment
    public function approving(Shipment $shipment)
    {
        // Update Shipment Status
        $shipment->status = 'Approving DTP';
        $shipment->save();

        // Create log
        $this->log->create(
            shipment: $shipment,
            type: LogType::SET_DTP
        );

        // Redirect to the daily trucking plan index page with a success message
        return redirect()->route('dtp.show', $shipment->id)->with('success', 'Sending approving DTP to Finance');
    }

    // Create: show the form to create new daily trucking plan
    public function create(Shipment $shipment)
    {
        // Redirect if a bill is already created for the shipment
        if ($shipment->bill_id) {
            return redirect()->route('dtp.show', $shipment->id)
                             ->with('error', 'Bill already created, cannot create add new truck for ' . $shipment->client->name);
        }

        // Retrieve available trucks and drivers
        $trucks = Truck::whereHas('state', fn($query) => $query->where('type', 'good'))
                    ->get()
                    ->sortBy('license_plate');
        $drivers = Driver::orderBy('name')->get();

        // Show the create form
        return view('admin.dtp.create', compact('shipment', 'trucks', 'drivers'));
    }

    // Store: store new daily trucking plan to database
    public function store(Request $request, Shipment $shipment)
    {
        // Redirect if a bill is already created for the shipment
        if ($shipment->bill_id) {
            return redirect()->route('dtp.show', $shipment->id)->with('error', 'Bill already created, cannot create add new truck for ' . $shipment->client->name);
        }

        // Validate the form
        $request->validate([
            // 'driver_name' => 'required',
            'size' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        // If truck is not vendor truck, validate truck_id
        if ($request->truck_id) {
            $request->validate([
                'truck_id' => 'required|exists:trucks,id',
            ]);
        }

        // Check `DTP` limit using `party` on `shipment`
        $totalDTP = DailyTruckingPlan::where('shipment_id', $shipment->id)->count();
        if ($totalDTP >= $shipment->party) {
            return redirect()->route('dtp.show', $shipment->id)->with('error', 'Cannot add new truck, DTP limit reached for ' . $shipment->client->name . ' party ' . $shipment->party . ' trucks');
        }

        // Create new daily trucking plan
        $dtp = new DailyTruckingPlan;
        $dtp->shipment_id = $shipment->id;
        $dtp->driver_name = 'N/A';
        // $dtp->driver_name = $request->driver_name;
        $dtp->size = $request->size;
        $dtp->price = $request->price;
        $dtp->is_vendor_truck = $request->truck_id ? false : true;
        $dtp->truck_id = $request->truck_id;

        // Create new daily trucking actual
        $dta = new DailyTruckingActually;
        $dta->shipment_id = $shipment->id;
        $dtp->driver_name = 'N/A';
        // $dta->driver_name = $request->driver_name;
        $dta->size = $request->size;
        $dta->price = $request->price;
        $dta->is_vendor_truck = $request->truck_id ? false : true;
        $dta->truck_id = $request->truck_id;

        // Create new destinations
        for ($i = 0; $i < 2; $i++) {
            // Destination 1
            if ($request->destination_1_detail != '') {
                $destination1 = new Destination;
                $destination1->type = 1;
                $destination1->detail = $request->destination_1_detail;
                if ($request->hasFile('destination_1_image')) {
                    $path = $request->file('destination_1_image')->store('destinations', 'public');
                    $destination1->image = 'storage/' . $path;
                }
                $destination1->save();
                if ($i == 0) {
                    $dtp->destination_1_id = $destination1->id;
                } else {
                    $dta->destination_1_id = $destination1->id;
                }
            }

            // Destination 2
            if ($request->destination_2_detail != '') {
                $destination2 = new Destination;
                $destination2->type = 2;
                $destination2->detail = $request->destination_2_detail;
                if ($request->hasFile('destination_2_image')) {
                    $path = $request->file('destination_2_image')->store('destinations', 'public');
                    $destination2->image = 'storage/' . $path;
                }
                $destination2->save();
                if ($i == 0) {
                    $dtp->destination_2_id = $destination2->id;
                } else {
                    $dta->destination_2_id = $destination2->id;
                }
            }

            // Destination 3
            if ($request->destination_3_detail != '') {
                $destination3 = new Destination;
                $destination3->type = 3;
                $destination3->detail = $request->destination_3_detail;
                if ($request->hasFile('destination_3_image')) {
                    $path = $request->file('destination_3_image')->store('destinations', 'public');
                    $destination3->image = 'storage/' . $path;
                }
                $destination3->save();
                if ($i == 0) {
                    $dtp->destination_3_id = $destination3->id;
                } else {
                    $dta->destination_3_id = $destination3->id;
                }
            }
        }

        // Save the daily trucking plan
        $dtp->save();

        // Save the daily trucking actual
        $dta->daily_trucking_plan_id = $dtp->id;
        $dta->save();

        // Redirect to the daily trucking plan index page
        return redirect()->route('dtp.show', $shipment->id)->with('success', 'Add truck on DTP ' . $shipment->client->name . ' successfully');
    }

    // Edit: show the form to edit daily trucking plan
    public function edit($shipment, $id)
    {
        // Get Data
        $dtp = DailyTruckingPlan::findOrFail($id);
        $shipment = Shipment::findOrFail($shipment);
        $trucks = Truck::whereHas('state', function ($query) {
            $query->where('type', 'good');
        })->get()->sortBy('license_plate');
        $drivers = Driver::orderBy('name')->get();

        // Check if bill is already created
        if ($shipment->bill_id) {
            return redirect()->route('dtp.show', $shipment->id)->with('error', 'Bill already created, cannot update truck on DTP ' . $shipment->client->name);
        } else {
            return view('admin.dtp.edit', compact('dtp', 'shipment', 'trucks', 'drivers'));
        }
    }

    // Update: update daily trucking plan to database
    public function update(Request $request, $shipment, $id)
    {
        // Validate the form
        $request->validate([
            // 'driver_name' => 'required',
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
            return redirect()->route('dtp.show', $shipment->id)->with('error', 'Bill already created, cannot update truck on DTP ' . $shipment->client->name);
        }

        // Find daily trucking plan
        $dtp = DailyTruckingPlan::findOrFail($id);

        // Update daily trucking plan
        // $dtp->driver_name = $request->driver_name;
        $dtp->size = $request->size;
        $dtp->price = $request->price;
        $dtp->is_vendor_truck = $request->truck_id ? false : true;
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
        return redirect()->route('dtp.show', $shipment->id)->with('success', 'Update truck on DTP '. $shipment->client->name .' successfully');
    }

    // Delete: delete daily trucking plan from database
    public function delete($shipment, $id)
    {
        // Find Shipments and Daily Trucking Plans
        $shipment = Shipment::findOrfail($shipment);
        $dtp = DailyTruckingPlan::findOrfail($id);
        $dta = DailyTruckingActually::where('daily_trucking_plan_id', $dtp->id)->first();

        // Check if bill already created
        if ($shipment->bill_id) {
            return redirect()->route('dtp.show', $shipment->id)->with('error', 'Bill already created, cannot delete truck on DTP '. $shipment->client->name);
        }

        // Delete daily trucking actually destination 1
        if ($dta->destination_1_id) {
            $destination1 = Destination::find($dta->destination_1_id);
            if ($destination1->image) {
                Storage::delete(str_replace('storage', 'public', $destination1->image));
            }
            $destination1->delete();
        }

        // Delete daily trucking actually destination 2
        if ($dta->destination_2_id) {
            $destination2 = Destination::find($dta->destination_2_id);
            if ($destination2->image) {
                Storage::delete(str_replace('storage', 'public', $destination2->image));
            }
            $destination2->delete();
        }

        // Delete daily trucking actually destination 3
        if ($dta->destination_3_id) {
            $destination3 = Destination::find($dta->destination_3_id);
            if ($destination3->image) {
                Storage::delete(str_replace('storage', 'public', $destination3->image));
            }
            $destination3->delete();
        }

        // Delete daily trucking actually
        $dta->delete();

        // Delete daily trucking plan destination 1
        if ($dtp->destination_1_id) {
            $destination1 = Destination::find($dtp->destination_1_id);
            if ($destination1->image) {
                Storage::delete(str_replace('storage', 'public', $destination1->image));
            }
            $destination1->delete();
        }

        // Delete daily trucking plan destination 2
        if ($dtp->destination_2_id) {
            $destination2 = Destination::find($dtp->destination_2_id);
            if ($destination2->image) {
                Storage::delete(str_replace('storage', 'public', $destination2->image));
            }
            $destination2->delete();
        }

        // Delete daily trucking plan destination 3
        if ($dtp->destination_3_id) {
            $destination3 = Destination::find($dtp->destination_3_id);
            if ($destination3->image) {
                Storage::delete(str_replace('storage', 'public', $destination3->image));
            }
            $destination3->delete();
        }

        // Delete daily trucking plan
        $dtp->delete();

        // Redirect to daily trucking plan index
        return redirect()->route('dtp.show', $shipment->id)->with('success', 'Delete truck on DTP' . $shipment->client->name . ' successfully');
    }

    // Approval Index: List of approval DTP by Finance
    public function approval_index()
    {
        $shipments = Shipment::latest()->get();
        return view('admin.dtp.approval.index', compact('shipments'));
    }

    // Approval Show: Display DTP by Finance
    public function approval_show(Shipment $shipment)
    {
        // Get Data
        $dtps = DailyTruckingPlan::where('shipment_id', $shipment->id)->get()->sortBy('truck.license_plate');

        // Show the approval show page
        return view('admin.dtp.approval.show', compact('dtps', 'shipment'));
    }

    // Approval Set: Approve DTP by Finance edit
    public function approval_set(Shipment $shipment)
    {
        // Update Shipment Status
        $shipment->status = 'Waiting DTA';
        $shipment->save();

        // Create log
        $this->log->create(
            shipment: $shipment,
            type: LogType::APPROVE_DTP
        );

        // Redirect to the approval index page with a success message
        return redirect()->route('dtp.approval.index', $shipment->id)
                         ->with('success', 'Success approving DTP for ' . $shipment->client->name . '.');
    }

    // Approval Edit: Display the form to edit the daily trucking plan
    public function approval_edit(Shipment $shipment, DailyTruckingPlan $dtp)
    {
        // Redirect if a bill is already created for the shipment
        if ($shipment->bill_id) {
            return redirect()->route('dtp.approval.show', $shipment->id)
                             ->with('error', 'Bill already created, cannot update truck on DTP for ' . $shipment->client->name);
        }

        // Retrieve available trucks and drivers
        $trucks = Truck::whereHas('state', fn($query) => $query->where('type', 'good'))
                    ->get()
                    ->sortBy('license_plate');
        $drivers = Driver::orderBy('name')->get();

        // Show the edit form
        return view('admin.dtp.approval.edit', compact('dtp', 'shipment', 'trucks', 'drivers'));
    }

    // Approval Update: Update the `price` of the daily trucking plan
    public function approval_update(Request $request, Shipment $shipment, DailyTruckingPlan $dtp)
    {
        // Validate the input data
        $request->validate([
            'price' => 'required|numeric',
        ]);

        // Redirect if a bill is already created for the shipment
        if ($shipment->bill_id) {
            return redirect()->route('dtp.show', $shipment->id)
                             ->with('error', 'Bill already created, cannot update truck on DTP for ' . $shipment->client->name);
        }

        // Update the daily trucking plan with the new price
        $dtp->price = $request->price;

        // Save the changes with error handling
        try {
            $dtp->save();
        } catch (\Exception $e) {
            return redirect()->route('dtp.approval.show', $shipment->id)
                             ->with('error', 'Failed to update truck on DTP: ' . $e->getMessage());
        }

        // Find DTA and update the price
        $dta = DailyTruckingActually::where('daily_trucking_plan_id', $dtp->id)->first();

        // Update the daily trucking actual with the new price
        $dta->price = $request->price;

        // Save the changes with error handling
        try {
            $dta->save();
        } catch (\Exception $e) {
            return redirect()->route('dtp.approval.show', $shipment->id)
                             ->with('error', 'Failed to update truck on DTP: ' . $e->getMessage());
        }

        // Redirect to the approval show page with a success message
        return redirect()->route('dtp.approval.show', $shipment->id)
                         ->with('success', 'Updated truck on DTP for ' . $shipment->client->name . ' successfully');
    }
}

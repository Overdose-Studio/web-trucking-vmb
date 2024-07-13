<?php

namespace App\Http\Controllers;

use App\Enums\LogType;
use App\Http\Services\LogService;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Shipment;

class ShipmentController extends Controller
{
    /**
     * ShipmentController constructor.
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
        return view('admin.shipment.index', compact('shipments'));
    }

    // Create: show form create shipment
    public function create()
    {
        $clients = Client::orderBy('name')->get();
        return view('admin.shipment.create', compact('clients'));
    }

    // Store: store shipment to database
    public function store(Request $request)
    {
        // Validate form
        $request->validate([
            'order_type' => 'required|in:import,export',
            'client_id' => 'required|exists:clients,id',
            'party' => 'required|numeric|min:0',
        ]);

        // Store shipment to database
        $shipment = new Shipment;
        $shipment->order_type = $request->order_type;
        $shipment->client_id = $request->client_id;
        $shipment->party = $request->party;
        $shipment->save();

        // Create log
        $this->log->create(
            shipment: $shipment,
            type: LogType::CREATE_SHIPMENT
        );

        // Redirect to shipment index page
        return redirect()->route('shipment.index')->with('success', 'Shipment created successfully.');
    }

    // Edit: show form edit shipment
    public function edit($id)
    {
        $shipment = Shipment::findOrFail($id);
        $clients = Client::orderBy('name')->get();
        if ($shipment->bill_id) {
            return redirect()->route('shipment.index', $shipment->id)->with('error', 'Bill already created, cannot edit shipment');
        }
        return view('admin.shipment.edit', compact('shipment', 'clients'));
    }

    // Update: update shipment to database
    public function update(Request $request, $id)
    {
        // Validate form
        $request->validate([
            'order_type' => 'required|in:import,export',
            'client_id' => 'required|exists:clients,id',
            'party' => 'required|numeric|min:0',
        ]);

        // Get shipment from database
        $shipment = Shipment::findOrFail($id);
        if ($shipment->bill_id) {
            return redirect()->route('shipment.index', $shipment->id)->with('error', 'Bill already created, cannot edit shipment');
        }

        // Update shipment to database
        $shipment->order_type = $request->order_type;
        $shipment->client_id = $request->client_id;
        $shipment->party = $request->party;
        $shipment->save();

        return redirect()->route('shipment.index')->with('success', 'Shipment updated successfully.');
    }

    // Delete: delete shipment from database
    public function delete($id)
    {
        // Get shipment from database
        $shipment = Shipment::findOrFail($id);
        if ($shipment->bill_id) {
            return redirect()->route('shipment.index', $shipment->id)->with('error', 'Bill already created, cannot delete shipment');
        }

        // Delete shipment from database
        $shipment->delete();

        return redirect()->route('shipment.index')->with('success', 'Shipment deleted successfully.');
    }
}

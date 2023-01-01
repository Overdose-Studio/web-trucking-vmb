<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Shipment;

class ShipmentController extends Controller
{
    // Create: show form create shipment
    public function create()
    {
        $clients = Client::orderBy('name')->get();
        return view('admin.dtp.create_shipment', compact('clients'));
    }

    // Store: store shipment to database
    public function store(Request $request)
    {
        // Validate form
        $request->validate([
            'order_type' => 'required|in:import,export',
            'client_id' => 'required|exists:clients,id',
        ]);

        // Store shipment to database
        $shipment = new Shipment;
        $shipment->order_type = $request->order_type;
        $shipment->client_id = $request->client_id;
        $shipment->save();

        return redirect()->route('dtp.index')->with('success', 'Shipment created successfully.');
    }

    // Edit: show form edit shipment
    public function edit($id)
    {
        $shipment = Shipment::findOrFail($id);
        $clients = Client::orderBy('name')->get();
        return view('admin.dtp.edit_shipment', compact('shipment', 'clients'));
    }

    // Update: update shipment to database
    public function update(Request $request, $id)
    {
        // Validate form
        $request->validate([
            'order_type' => 'required|in:import,export',
            'client_id' => 'required|exists:clients,id',
        ]);

        // Update shipment to database
        $shipment = Shipment::findOrFail($id);
        $shipment->order_type = $request->order_type;
        $shipment->client_id = $request->client_id;
        $shipment->save();

        return redirect()->route('dtp.index')->with('success', 'Shipment updated successfully.');
    }

    // Delete: delete shipment from database
    public function delete($id)
    {
        $shipment = Shipment::findOrFail($id);
        $shipment->delete();

        return redirect()->route('dtp.index')->with('success', 'Shipment deleted successfully.');
    }
}

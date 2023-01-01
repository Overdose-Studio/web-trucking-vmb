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
}

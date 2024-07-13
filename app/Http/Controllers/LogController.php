<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class LogController extends Controller
{
    // Index: show all logs of a shipment
    public function index()
    {
        // Get all logs of a shipment
        $shipments = Shipment::whereHas('logs')
            ->latest()
            ->get();

        // Return view
        return view('admin.log.index', compact('shipments'));
    }
}
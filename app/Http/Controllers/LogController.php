<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    // Index: show all logs of a shipment
    public function index()
    {
        // Get all logs of a shipment
        $logs = Log::all()
                ->groupBy('shipment_id')
                ->load('shipment');

        // Return view
        return view('admin.log.index', compact('logs'));
    }
}
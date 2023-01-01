<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Shipment;
use Illuminate\Http\Request;

class BillController extends Controller
{
    // Index: show all bills
    public function index()
    {
        $shipments = Shipment::latest()->get();
        return view('admin.bill.index', compact('shipments'));
    }

    // Create: show form create bill
    public function create(Shipment $shipment)
    {
        return view('export.invoice');
        // return view('admin.bill.create', compact('shipment'));
    }
}

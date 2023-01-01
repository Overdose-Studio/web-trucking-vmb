<?php

namespace App\Http\Controllers;

use App\Exports\InvoiceExport;
use App\Models\Bill;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BillController extends Controller
{
    // Index: show all bills
    public function index()
    {
        $bills = Bill::latest()->get();
        $shipments = Shipment::where('bill_id', null)->get()->sortBy('id');
        return view('admin.bill.index', compact('bills', 'shipments'));
    }

    // Create: show form create bill
    public function create(Shipment $shipment)
    {
        // return view('export.invoice');
        return Excel::download(new InvoiceExport(1), '-' . time() . '.xlsx');
        // return view('admin.bill.create', compact('shipment'));
    }
}

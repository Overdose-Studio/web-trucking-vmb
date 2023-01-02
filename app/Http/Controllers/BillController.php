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
    public function create()
    {
        // Get all shipments
        $shipments = Shipment::where('bill_id', null)->get()->sortBy('id');
        if ($shipments->isEmpty()) {
            return redirect()->route('bill.index')->with('error', 'No shipments to create bill.');
        }

        // Return view
        return view('admin.bill.create');
    }

    // Store: store bill to database
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'number' => 'required',
            'name' => 'required',
            'address' => 'required',
            'person_in_charge' => 'required',
        ]);

        // Get all shipments
        $shipments = Shipment::where('bill_id', null)->get()->sortBy('id');
        if ($shipments->isEmpty()) {
            return redirect()->route('bill.index')->with('error', 'No shipments to create bill.');
        }

        // Store bill to database
        $bill = new Bill;
        $bill->number = $request->number;
        $bill->name = $request->name;
        $bill->address = $request->address;
        $bill->person_in_charge = $request->person_in_charge;
        $bill->status = 'generated';
        $bill->note = null;     // Change null to note when needed
        $bill->invoice = '';    // Change '' to invoice file
        $bill->save();

        // Get all shipments
        $shipments = Shipment::where('bill_id', null)->get()->sortBy('id');

        // Update bill_id for each shipment
        foreach ($shipments as $shipment) {
            $shipment->bill_id = $bill->id;
            $shipment->save();
        }

        // Redirect to bill index
        return redirect()->route('bill.index')->with('success', 'Bill created successfully.');
    }

    // Edit: show form edit bill
    public function edit($id)
    {
        // Get bill from database
        $bill = Bill::findOrFail($id);

        // Return view
        return view('admin.bill.edit', compact('bill'));
    }

    // Update: update bill to database
    public function update(Request $request, $id)
    {
        // Validate request
        $request->validate([
            'number' => 'required',
            'name' => 'required',
            'address' => 'required',
            'person_in_charge' => 'required',
        ]);

        // Get bill from database
        $bill = Bill::findOrFail($id);

        // Update bill to database
        $bill->number = $request->number;
        $bill->name = $request->name;
        $bill->address = $request->address;
        $bill->person_in_charge = $request->person_in_charge;
        $bill->note = null;     // Change null to note when needed
        $bill->invoice = '';    // Change '' to invoice file
        $bill->save();

        // Redirect to bill index
        return redirect()->route('bill.index')->with('success', 'Bill updated successfully.');
    }

    // Delete: delete bill from database
    public function delete($id)
    {
        // Get bill from database
        $bill = Bill::findOrFail($id);

        // Get all shipments
        $shipments = Shipment::where('bill_id', $bill->id)->get()->sortBy('id');

        // Update bill_id for each shipment
        foreach ($shipments as $shipment) {
            $shipment->bill_id = null;
            $shipment->save();
        }

        // Delete bill from database
        $bill->delete();

        // Redirect to bill index
        return redirect()->route('bill.index')->with('success', 'Bill deleted successfully.');
    }

    // Export: export bill to excel
    public function export($id)
    {
        // Get bill from database
        $bill = Bill::findOrFail($id);

        // Get all shipments
        $shipments = Shipment::where('bill_id', $bill->id)->get()->sortBy('id');

        // Export bill to excel
        return Excel::download(new InvoiceExport($bill, $shipments), 'invoice-' . $bill->number . '.xlsx');
    }
}

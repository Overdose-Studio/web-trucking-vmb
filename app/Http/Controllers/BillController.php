<?php

namespace App\Http\Controllers;

use App\Enums\LogType;
use App\Exports\InvoiceExport;
use App\Http\Services\LogService;
use App\Models\Bill;
use App\Models\DailyTruckingActually;
use App\Models\DailyTruckingPlan;
use App\Models\Shipment;
use App\Models\Truck;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BillController extends Controller
{
    /**
     * BillController constructor.
     *
     * Initializes the service with the provided LogService instance.
     *
     * @param LogService $service The LogService instance.
     */
    public function __construct(private LogService $log) {}

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
        $shipments = Shipment::where('bill_id', null)
            ->where('status', 'Waiting Bill')
            ->get()
            ->sortBy('id');

        // Update bill_id for each shipment
        foreach ($shipments as $shipment) {
            $shipment->bill_id = $bill->id;
            $shipment->status = 'Completed';
            $shipment->save();
        }

        // Create log for each shipment
        foreach ($shipments as $shipment) {
            $this->log->create(
                shipment: $shipment,
                type: LogType::CREATE_BILL,
            );
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
            $shipment->status = 'Waiting Bill';
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
        return Excel::download(new InvoiceExport($bill, $shipments), 'invoice.xlsx');
    }

    // DTP Detail: Display DTP
    public function dtp_detail($shipment)
    {
        $shipment = Shipment::findOrFail($shipment);
        $dtps = DailyTruckingPlan::where('shipment_id', $shipment->id)->get()->sortBy('truck.license_plate');
        return view('admin.bill.dtp.detail', compact('dtps', 'shipment'));
    }

    // DTA Detail: Display DTA
    public function dta_detail($shipment)
    {
        $shipment = Shipment::findOrFail($shipment);
        $dtas = DailyTruckingActually::where('shipment_id', $shipment->id)->get()->sortBy('truck.license_plate');
        return view('admin.bill.dta.detail', compact('dtas', 'shipment'));
    }

    // DTA Truck: Display Truck
    public function dta_truck($shipment, $id)
    {
        // Get data
        $dta = DailyTruckingActually::findOrFail($id);
        $shipment = Shipment::findOrfail($shipment);
        $selected = DailyTruckingPlan::where('id', $dta->daily_trucking_plan_id)->first();
        $trucks = Truck::whereHas('state', function ($query) {
            $query->where('type', 'good');
        })->get()->sortBy('license_plate');

        // Return view
        return view('admin.bill.dta.truck', compact('dta', 'shipment', 'selected', 'trucks'));
    }
}

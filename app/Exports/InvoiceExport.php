<?php

namespace App\Exports;

// use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoiceExport implements FromView
{
    protected $bill;
    protected $shipments;

    public function __construct($bill, $shipments)
    {
        $this->bill = $bill;
        $this->shipments = $shipments;
    }

    public function view(): View
    {
        return view('export.invoice', [
            'bill' => $this->bill,
            'shipments' => $this->shipments,
        ]);
    }
}

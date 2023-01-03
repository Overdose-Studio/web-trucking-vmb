<?php

namespace App\Exports;

// use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;

class InvoiceExport implements FromView, WithColumnWidths, WithStyles, WithDefaultStyles
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

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 15,
            'C' => 15,
            'D' => 25,
            'E' => 15,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('D2')
            ->getAlignment()
            ->setWrapText(true);
    }
    public function defaultStyles(Style $defaultStyle)
    {
        return [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
    }
}

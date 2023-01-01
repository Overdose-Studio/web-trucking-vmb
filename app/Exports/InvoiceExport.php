<?php

namespace App\Exports;

// use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoiceExport implements FromView
{
    public function __construct($token)
    {
        $this->token = $token;
    }

    public function view(): View
    {
        // $form = Form::where('token', $this->token)->first();
        // $isOpen = $isOpen = $form->deadline > now('Asia/Jakarta');
        return view('export.invoice', [
            // 'form' => $form,
            // 'isOpen' => $isOpen,
        ]);
    }

    // public function properties(): array
    // {
    //     $author = Form::where('token', $this->token)->first()->author;
    //     return [
    //         'creator'        => $author,
    //     ];
    // }
}

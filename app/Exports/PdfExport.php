<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromView;

class PdfExport implements FromView
{
    protected $invoices;

    public function __construct(array $invoices)
    {
        $this->invoices = $invoices;
    }
    public function view(): View
    {
        return view('exports.pdf', [
            'seguro' => $this->invoices,
        ]);
    }
}


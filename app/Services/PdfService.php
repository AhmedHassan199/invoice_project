<?php

namespace App\Services;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfService
{
    public function makeInvoicePdf(Invoice $invoice){
        $pdf = Pdf::loadView('invoices.pdf', ['invoice'=>$invoice]);
        return $pdf;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Services\ClientService;
use App\Services\InvoiceService;
use App\Services\PdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function __construct(
        private InvoiceService $invoices,
        private ClientService $clients,
        private PdfService $pdfs
    ) {}

    public function index(Request $request){
        $q = $request->query('q');
        $list = $this->invoices->paginate(Auth::id(), $q, 10);
        return view('invoices.index', compact('list','q'));
    }

    public function create(){
        $clients = $this->clients->all(Auth::id());
        return view('invoices.create', compact('clients'));
    }

    public function store(InvoiceRequest $request){
        $data = $request->validated();
        $invoice = $this->invoices->create(Auth::id(), [
            'client_id'    => $data['client_id'],
            'invoice_date' => $data['invoice_date'],
            'due_date'     => $data['due_date'] ,
        ], $data['items']);

        return redirect()->route('invoices.show', $invoice)->with('success','Invoice created.');
    }

    public function show(Invoice $invoice){
        abort_unless($invoice->user_id === Auth::id() || Auth::user()->isAdmin(), 403);
        $invoice->load('client','items');
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice){
        abort_unless($invoice->user_id === Auth::id() || Auth::user()->isAdmin(), 403);
        $clients = $this->clients->all(Auth::id());
        $invoice->load('items');
        return view('invoices.edit', compact('invoice','clients'));
    }

    public function update(InvoiceRequest $request, Invoice $invoice){
        abort_unless($invoice->user_id === Auth::id() || Auth::user()->isAdmin(), 403);
        $data = $request->validated();
        $this->invoices->update($invoice, [
            'client_id'    => $data['client_id'],
            'invoice_date' => $data['invoice_date'],
            'due_date'     => $data['due_date'] ?? null,
        ], $data['items']);

        return redirect()->route('invoices.show',$invoice)->with('success','Invoice updated.');
    }

    public function destroy(Invoice $invoice){
        abort_unless($invoice->user_id === Auth::id() || Auth::user()->isAdmin(), 403);
        $this->invoices->delete($invoice);
        return redirect()->route('invoices.index')->with('success','Invoice deleted.');
    }

    public function pdf(Invoice $invoice){
        abort_unless($invoice->user_id === Auth::id() || Auth::user()->isAdmin(), 403);
        $invoice->load('client','items');
        $pdf = $this->pdfs->makeInvoicePdf($invoice);
        return $pdf->download("{$invoice->invoice_number}.pdf");
    }
    
}

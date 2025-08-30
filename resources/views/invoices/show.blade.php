@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Invoice {{ $invoice->invoice_number }}</h4>
  <div>
    <a class="btn btn-outline-dark btn-sm" href="{{ route('invoices.pdf',$invoice) }}">Download PDF</a>
    <a class="btn btn-outline-primary btn-sm" href="{{ route('invoices.edit',$invoice) }}">Edit</a>
    <a class="btn btn-secondary btn-sm" href="{{ route('invoices.index') }}">Back</a>
  </div>
</div>

<div class="card mb-3">
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <h6>Client</h6>
        <div><strong>{{ $invoice->client->name }}</strong></div>
        <div>{{ $invoice->client->email }}</div>
        <div>{{ $invoice->client->phone }}</div>
        <div>{{ $invoice->client->address }}</div>
      </div>
      <div class="col-md-6 text-md-end">
        <div><strong>Invoice Date:</strong> {{ $invoice->invoice_date }}</div>
        <div><strong>Due Date:</strong> {{ $invoice->due_date }}</div>
        <div><strong>Total:</strong> {{ number_format($invoice->total_amount,2) }}</div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="table-responsive">
    <table class="table mb-0">
      <thead><tr><th>Description</th><th class="text-end">Qty</th><th class="text-end">Unit Price</th><th class="text-end">Total</th></tr></thead>
      <tbody>
        @foreach($invoice->items as $it)
        <tr>
          <td>{{ $it->description }}</td>
          <td class="text-end">{{ $it->quantity }}</td>
          <td class="text-end">{{ number_format($it->unit_price,2) }}</td>
          <td class="text-end">{{ number_format($it->total,2) }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr><th colspan="3" class="text-end">Grand Total</th><th class="text-end">{{ number_format($invoice->total_amount,2) }}</th></tr>
      </tfoot>
    </table>
  </div>
</div>
@endsection

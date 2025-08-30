@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Invoices</h4>
  <a href="{{ route('invoices.create') }}" class="btn btn-success">New Invoice</a>
</div>

<form class="row g-2 mb-3" method="GET">
  <div class="col-auto">
    <input class="form-control" name="q" value="{{ $q }}" placeholder="Search by number or client name">
  </div>
  <div class="col-auto"><button class="btn btn-outline-primary">Search</button></div>
</form>

<div class="card">
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead><tr>
        <th>#</th><th>Client</th><th>Invoice Date</th><th>Due Date</th><th class="text-end">Total</th><th></th>
      </tr></thead>
      <tbody>
        @forelse($list as $inv)
        <tr>
          <td>{{ $inv->invoice_number }}</td>
          <td>{{ $inv->client->name ?? '-' }}</td>
          <td>{{ $inv->invoice_date }}</td>
          <td>{{ $inv->due_date }}</td>
          <td class="text-end">{{ number_format($inv->total_amount,2) }}</td>
          <td class="text-end">
            <a class="btn btn-sm btn-outline-secondary" href="{{ route('invoices.show',$inv) }}">View</a>
            <a class="btn btn-sm btn-outline-primary" href="{{ route('invoices.edit',$inv) }}">Edit</a>
            <a class="btn btn-sm btn-outline-dark" href="{{ route('invoices.pdf',$inv) }}">PDF</a>
            <form action="{{ route('invoices.destroy',$inv) }}" method="POST" class="d-inline">@csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete invoice?')">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center text-muted">No invoices.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
<div class="mt-3">{{ $list->links() }}</div>
@endsection

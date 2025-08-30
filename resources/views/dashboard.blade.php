@extends('layouts.app')
@section('content')
<div class="row g-3">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Quick Actions</h5>
        <a href="{{ route('clients.create') }}" class="btn btn-outline-primary btn-sm">New Client</a>
        <a href="{{ route('invoices.create') }}" class="btn btn-outline-success btn-sm">New Invoice</a>
      </div>
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')
@section('content')
<h4 class="mb-3">New Invoice</h4>
<form method="POST" action="{{ route('invoices.store') }}">@csrf
  @include('invoices.partials.form', ['invoice'=>null,'clients'=>$clients])
  <button class="btn btn-success">Save Invoice</button>
  <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection

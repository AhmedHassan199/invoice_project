@extends('layouts.app')
@section('content')
<h4 class="mb-3">Edit Invoice</h4>
<form method="POST" action="{{ route('invoices.update',$invoice) }}">@csrf @method('PUT')
  @include('invoices.partials.form', ['invoice'=>$invoice,'clients'=>$clients])
  <button class="btn btn-primary">Update Invoice</button>
  <a href="{{ route('invoices.show',$invoice) }}" class="btn btn-secondary">Back</a>
</form>
@endsection

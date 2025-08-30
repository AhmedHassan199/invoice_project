@extends('layouts.app')
@section('content')
<h4 class="mb-3">New Client</h4>
<form method="POST" action="{{ route('clients.store') }}">@csrf
  @include('clients.partials.form')
  <button class="btn btn-success">Save</button>
  <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection

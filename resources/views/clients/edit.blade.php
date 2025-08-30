@extends('layouts.app')
@section('content')
<h4 class="mb-3">Edit Client</h4>
<form method="POST" action="{{ route('clients.update',$client) }}">@csrf @method('PUT')
  @include('clients.partials.form', ['client'=>$client])
  <button class="btn btn-primary">Update</button>
  <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection

@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="mb-3">Login</h4>
        <form method="POST" action="{{ url('/login') }}">@csrf
          <div class="mb-3">
            <label class="form-label form-required">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label form-required">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
          </div>
          <button class="btn btn-primary w-100">Login</button>
          <p class="mt-3">No account? <a href="{{ route('register') }}">Register</a></p>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

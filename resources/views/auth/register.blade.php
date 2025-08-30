@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="mb-3">Register</h4>
        <form method="POST" action="{{ url('/register') }}">@csrf
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label form-required">Name</label>
              <input name="name" value="{{ old('name') }}" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label form-required">Email</label>
              <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label form-required">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label form-required">Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control" required>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select">
              <option value="user" selected>User</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <button class="btn btn-success w-100">Create account</button>
          <p class="mt-3"><a href="{{ route('login') }}">Back to login</a></p>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

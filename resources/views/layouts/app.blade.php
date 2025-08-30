<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style> .form-required:after{content:" *"; color:#c00;} </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('dashboard') }}">InvoiceApp</a>
    <div class="collapse navbar-collapse">
      @auth
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('clients.index') }}">Clients</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('invoices.index') }}">Invoices</a></li>
      </ul>
      <div class="d-flex align-items-center gap-3">
        <span class="text-muted">Hi, {{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
        <form method="POST" action="{{ route('logout') }}">@csrf
          <button class="btn btn-outline-danger btn-sm">Logout</button>
        </form>
      </div>
      @endauth
      @guest
        <div class="ms-auto">
          <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Login</a>
        </div>
      @endguest
    </div>
  </div>
</nav>

<main class="container">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    </div>
  @endif

  @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>

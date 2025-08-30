@php($client = $client ?? null)
<div class="row">
  <div class="col-md-6 mb-3">
    <label class="form-label form-required">Name</label>
    <input name="name" class="form-control" value="{{ old('name', $client->name ?? '') }}" required>
  </div>
  <div class="col-md-6 mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $client->email ?? '') }}">
  </div>
  <div class="col-md-6 mb-3">
    <label class="form-label">Phone</label>
    <input name="phone" class="form-control" value="{{ old('phone', $client->phone ?? '') }}">
  </div>
  <div class="col-md-6 mb-3">
    <label class="form-label">Address</label>
    <input name="address" class="form-control" value="{{ old('address', $client->address ?? '') }}">
  </div>
</div>

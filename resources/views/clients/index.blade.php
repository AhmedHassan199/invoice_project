@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Clients</h4>
  <a href="{{ route('clients.create') }}" class="btn btn-primary">Add Client</a>
</div>

<div class="card">
  <div class="table-responsive">
    <table class="table table-striped mb-0">
      <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th></th></tr></thead>
      <tbody>
        @forelse($list as $client)
        <tr>
          <td>{{ $client->name }}</td>
          <td>{{ $client->email }}</td>
          <td>{{ $client->phone }}</td>
          <td>{{ $client->address }}</td>
          <td class="text-end">
            <a href="{{ route('clients.edit',$client) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            <form action="{{ route('clients.destroy',$client) }}" method="POST" class="d-inline">@csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete client?')">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center text-muted">No clients.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
<div class="mt-3">{{ $list->links() }}</div>
@endsection

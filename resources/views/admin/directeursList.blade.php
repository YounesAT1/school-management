@extends('layouts.app')

@section('content')
  <div class="container">
    @if (session('success'))
      <div class="d-flex justify-content-center">
        <div class="alert alert-success alert-dismissible fade show col-6" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    @endif
    <div class="card">
      <div class="card-header h4 fw-bold d-flex justify-content-between">
        <h3>Directors List</h3>
      </div>

      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th class="align-middle">ID</th>
              <th class="align-middle">Full Name</th>
              <th class="align-middle">Email</th>
              <th class="align-middle">School</th>
              <th class="align-middle">Status</th>
              <th class="align-middle">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($directeursList as $user)
              <tr>
                <td class="align-middle">{{ $user->id }}</td>
                <td class="align-middle">{{ $user->firstName }} {{ $user->lastName }}</td>
                <td class="align-middle">{{ $user->email }}</td>
                <td class="align-middle">{{ $user->school->name }}</td>
                <td class="align-middle">
                  @if ($user->active === 1)
                    <span class="text-success fw-bold">Active</span>
                  @else
                    <span class="text-danger fw-bold">Inactive</span>
                  @endif
                </td>
                <td class="align-middle">
                  <div class="d-flex" role="group">
                    @if ($user->active === 1)
                      <form action="{{ route('admin.deactivateDirector', $user->id) }}" method="POST" class="me-1">
                        @csrf
                        <button type="submit" class="btn btn-warning">Deactivate</button>
                      </form>
                    @else
                      <form action="{{ route('admin.activateDirector', $user->id) }}" method="POST" class="me-1">
                        @csrf
                        <button type="submit" class="btn btn-success">Activate</button>
                      </form>
                    @endif
                    <form action="{{ route('admin.deleteUser', $user) }}" method="POST" class="ms-1">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td class="bg-danger-subtle fw-bold text-center h4" colspan="6">No users available</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

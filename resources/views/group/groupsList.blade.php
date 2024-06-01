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
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3>{{ __('Groups List') }}</h3>
            <a href="{{ route('director.createGroup') }}" class="btn btn-primary">Add</a>
          </div>

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Number of students</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($groupsList as $group)
                  <tr>
                    <td>{{ $group->id }}</td>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->description }}</td>
                    <td>{{ count($group->student) }}</td>
                    <td>
                      <a href="{{ route('director.editGroup', $group) }}" class="btn btn-success">Edit</a>
                      <form action="{{ route('director.destroyGroup', $group) }}" method="POST"
                        style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center fw-bold h4">No groups available.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

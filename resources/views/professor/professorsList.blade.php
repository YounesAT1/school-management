@extends('layouts.app')

@section('content')
  <div class="container">
    @if (session('success'))
      <div class="d-flex justify-content-center">
        <div class="alert alert-success alert-dismissible fade show col-6 " role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    @endif
    <div class="card">
      <div class="card-header h4 fw-bold d-flex justify-content-between ">

        <h3> Professors List</h3>
      </div>

      <div class="card-body">

        <table class="table ">
          <thead>
            <tr>
              <th class="align-middle">ID</th>
              <th class="align-middle">Full name</th>
              <th class="align-middle">Email</th>
              <th class="align-middle">School</th>
              <th class="align-middle">Status</th>
              <th class="align-middle">Actions</th>

            </tr>
          </thead>
          <tbody>
            @forelse ($professorsList as $user)
              <tr>
                <td class="align-middle">{{ $user->id }}</td>
                <td class="align-middle">{{ $user->firstName }} {{ $user->lastName }}</td>
                <td class="align-middle">{{ $user->email }}</td>
                <td class="align-middle">{{ $user->school_name }}</td>
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
                      <form action="{{ route('director.deactivateStudentOrProfessor', $user->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-warning me-1">Deactivate</button>
                      </form>
                    @else
                      <form action="{{ route('director.activateStudentOrProfessor', $user->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-success me-1">Activate</button>
                      </form>
                    @endif
                    @if (Auth::user()->id === $user->id)
                      <button class="btn btn-danger ms-1" disabled>Delete</button>
                    @else
                      <form action="{{ route('admin.deleteUser', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger ms-1">Delete</button>
                      </form>
                    @endif
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

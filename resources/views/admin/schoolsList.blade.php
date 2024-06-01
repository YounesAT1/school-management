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

        <h3> Schools List</h3>
        <a href="{{ route('admin.createSchool') }}" class="btn btn-primary">Add a school</a>
      </div>

      <div class="card-body">

        <table class="table ">
          <thead>
            <tr>
              <th class="align-middle">ID</th>
              <th class="align-middle">Name</th>
              <th class="align-middle">Address</th>
              <th class="align-middle">Picture</th>
              <th class="align-middle">Actions</th>

            </tr>
          </thead>
          <tbody>
            @forelse ($schoolsList as $school)
              <tr>
                <td class="align-middle">{{ $school->id }}</td>
                <td class="align-middle">{{ $school->name }} </td>
                <td class="align-middle">{{ $school->address }}</td>
                <td class="align-middle">
                  <img src="/{{ $school->picture }}" alt="schoolPicture"
                    style="width: 50px; height:50px;border-radius:50%" />
                </td>
                <td class="align-middle">
                  <div class="d-flex" role="group">
                    <a href="{{ route('admin.schoolDetails', $school) }}" class="btn btn-primary">Details</a>
                    <form action="{{ route('admin.destroySchool', $school) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger ms-1">Delete</button>

                    </form>
                    <a href="{{ route('admin.modifySchool', $school) }}" class="btn btn-success ms-1">Update</a>
                  </div>

                </td>

              </tr>
            @empty
              <tr>
                <td class="bg-danger-subtle fw-bold text-center h4" colspan="5">No users available</td>
              </tr>
            @endforelse
          </tbody>
        </table>

      </div>
    </div>
  </div>
@endsection

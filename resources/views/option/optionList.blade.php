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
            <h3>{{ __('Options List') }}</h3>
            <a href="{{ route('director.createOption') }}" class="btn btn-primary">Add</a>
          </div>

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>School</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($optionsList as $option)
                  <tr>
                    <td>{{ $option->id }}</td>
                    <td>{{ $option->name }}</td>
                    <td>{{ $option->school->name }}</td>
                    <td>
                      <a href="{{ route('director.editOption', $option) }}" class="btn btn-success">Edit</a>
                      <form action="{{ route('director.destroyOption', $option) }}" method="POST"
                        style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center fw-bold h4">No options available.</td>
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

@extends('layouts.app')

@section('content')
  <div class="container">
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h3 class="m-0">{{ __('Modules List') }}</h3>
            <a href="{{ route('director.createModule') }}" class="btn btn-primary">Add Module</a>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead class="bg-primary text-white">
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Number of Hours</th>
                    <th>Option</th>
                    <th>Group</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($modulesList as $module)
                    <tr>
                      <td>{{ $module->id }}</td>
                      <td>{{ $module->name }}</td>
                      <td>{{ $module->numberOfHours }}</td>
                      <td>{{ $module->option->name }}</td>
                      <td>{{ $module->group->name }}</td>
                      <td>
                        <a href="{{ route('director.editModule', $module) }}" class="btn btn-success ">Edit</a>
                        <form action="{{ route('director.deleteModule', $module) }}" method="POST"
                          style="display: inline-block;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger ">Delete</button>
                        </form>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center fw-bold h4">No modules available.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

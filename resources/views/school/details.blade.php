@extends('layouts.app')

@section('content')
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h3>{{ $school->name }}</h3>
          </div>
          <div class="card-body">
            <div class="mb-4">
              <h5 class="text-primary">Address</h5>
              <p>{{ $school->address }}</p>
            </div>
            <div class="mb-4">
              <h5 class="text-primary">Directors</h5>
              <ul class="list-group">
                @forelse ($school->directors as $director)
                  <li class="list-group-item">
                    <div class="d-flex align-items-center">
                      <div class="mr-3">
                        <img src="/{{ $director->picture }}" alt="Director Picture" class="rounded-circle" width="50"
                          height="50">
                      </div>
                      <div class="ms-2">
                        <strong>{{ $director->firstName }} {{ $director->lastName }}</strong><br>
                        <small>{{ $director->email }}</small>
                      </div>
                    </div>
                  </li>
                @empty
                  <li class="list-group-item">No directors assigned to this school.</li>
                @endforelse
              </ul>
            </div>
            <a href="{{ route('admin.schoolsList') }}" class="btn btn-primary">Back to School List</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h5>Picture</h5>
          </div>
          <div class="card-body">
            @if ($school->picture)
              <img src="/{{ $school->picture }}" alt="School Picture" class="img-fluid img-thumbnail"
                style="max-width: full ; ">
            @else
              <p>No picture available</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@extends('layouts.app')

@section('content')
  <div class="container">


    <div class="d-flex justify-content-center mt-5">
      <div class="card col-8">
        <div class="card-header">
          {{ $school->name }} details
        </div>
        <div class="card-body">
          <form action="{{ route('admin.updateSchool', $school) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-3">
              <label for="schoolName" class="col-md-4 col-form-label text-md-end">{{ __('School Name') }}</label>
              <div class="col-md-6">
                <input id="schoolName" type="text" class="form-control @error('schoolName') is-invalid @enderror"
                  name="schoolName" value="{{ $school->name }}" required autocomplete="schoolName" autofocus>
                @error('schoolName')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="schoolAddress" class="col-md-4 col-form-label text-md-end">{{ __('School Address') }}</label>
              <div class="col-md-6">
                <input id="schoolAddress" type="text" class="form-control @error('schoolAddress') is-invalid @enderror"
                  name="schoolAddress" value="{{ $school->address }}" required autocomplete="schoolAddress" autofocus>
                @error('schoolAddress')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="mb-3 row">
              <div class="col-md-12  d-flex justify-content-center ms-3">
                <img src="/{{ $school->picture }}" alt="{{ $school->name }}"
                  style="width: 300px; height:150px; border-radius:10px">
              </div>
            </div>

            <div class="row mb-3">
              <label for="schoolPicture" class="col-md-4 col-form-label text-md-end">School Picture</label>
              <div class="col-md-6">
                <input type="file" name="schoolPicture" id="schoolPicture"
                  class="form-control @error('schoolPicture') is-invalid @enderror">
                @error('schoolPicture')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  Update
                </button>
                <a href="{{ route('admin.schoolsList') }}" class="btn btn-danger">Cancel</a>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>
@endsection

@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <p class="card-header">Add a School</p>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.storeSchool') }}">
              @csrf
              <div class="row mb-3">
                <label for="schoolName" class="col-md-4 col-form-label text-md-end">{{ __('School Name') }}</label>
                <div class="col-md-6">
                  <input id="schoolName" type="text" class="form-control @error('schoolName') is-invalid @enderror"
                    name="schoolName" value="{{ old('schoolName') }}" required autocomplete="schoolName" autofocus>
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
                  <input id="schoolAddress" type="text"
                    class="form-control @error('schoolAddress') is-invalid @enderror" name="schoolAddress"
                    value="{{ old('schoolAddress') }}" required autocomplete="schoolAddress" autofocus>
                  @error('schoolAddress')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="schoolPicture" class="col-md-4 col-form-label text-md-end">School Picture</label>
                <div class="col-md-6">
                  <input type="file" name="schoolPicture" id="schoolPicture"
                    class="form-control @error('schoolPicture') is-invalid @enderror" required>
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
                    Add
                  </button>
                  <a href="{{ route('admin.schoolsList') }}" class="btn btn-danger">Cancel</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

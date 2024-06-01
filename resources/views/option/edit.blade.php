@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Edit option with the ID : {{ $option->id }} </div>

          <div class="card-body">
            <form method="POST" action="{{ route('director.updateOption', $option) }}" autocomplete="off">
              @csrf
              @method('PUT')

              <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                  name="name" value="{{ $option->name }}" required autofocus>
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                <a href="{{ route('director.showOptionsList') }}" class="btn btn-danger">{{ __('Cancel') }}</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

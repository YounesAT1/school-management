@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header bg-dark text-white">{{ __('Create Module') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('director.storeModule') }}" autocomplete="off">
              @csrf

              <div class="mb-3">
                <label for="name" class="form-label">{{ __('Module Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                  name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="hours" class="form-label">{{ __('Number of Hours') }}</label>
                <input id="hours" type="number" class="form-control @error('hours') is-invalid @enderror"
                  name="numberOfHours" value="{{ old('numberOfHours') }}" required>
                @error('hours')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="option_id" class="form-label">{{ __('Option') }}</label>
                <select id="option_id" class="form-select @error('option_id') is-invalid @enderror" name="option_id"
                  required>
                  <option value="" selected disabled>Select an Option</option>
                  @foreach ($optionsList as $option)
                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                  @endforeach
                </select>
                @error('option_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="group_id" class="form-label">{{ __('Group') }}</label>
                <select id="group_id" class="form-select @error('group_id') is-invalid @enderror" name="group_id"
                  required>
                  <option value="" selected disabled>Select a Group</option>
                  @foreach ($groupsList as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                  @endforeach
                </select>
                @error('group_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3">
                <button type="submit" class="btn btn-primary">{{ __('Create Module') }}</button>
                <a href="{{ route('director.showModulesList') }}" class="btn btn-danger">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

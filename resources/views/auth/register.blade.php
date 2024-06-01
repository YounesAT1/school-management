@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h1 class="navbar-brand fw-bold text-center "
              style="background-color: rgba(197, 30, 197, 0.8); color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
              EduManage
            </h1>
          </div>

          <div class="card-body">
            <h4 class="text-center fw-bold mt-2 my-4 h2">Create your personal account now</h4>
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
              @csrf

              <div class="row mb-3">
                <label for="firstName" class="col-md-4 col-form-label text-md-end">{{ __('First name') }}</label>
                <div class="col-md-6">
                  <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror"
                    name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>
                  @error('firstName')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="lastName" class="col-md-4 col-form-label text-md-end">{{ __('Last name') }}</label>
                <div class="col-md-6">
                  <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror"
                    name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName">
                  @error('lastName')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="idRole" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
                <div class="col-md-6">
                  <select id="idRole" class="form-control @error('idRole') is-invalid @enderror" name="idRole"
                    required onchange="toggleCNEField()">
                    <option value="" disabled selected>Select a role</option>
                    @foreach ($rolesList->take(3) as $role)
                      <option value="{{ $role->idRole }}" {{ old('idRole') == $role->idRole ? 'selected' : '' }}>
                        {{ $role->name }}</option>
                    @endforeach
                  </select>
                  @error('idRole')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="school_id" class="col-md-4 col-form-label text-md-end">{{ __('School') }}</label>
                <div class="col-md-6">
                  <select id="school_id" class="form-control @error('school_id') is-invalid @enderror" name="school_id"
                    required>
                    <option value="" disabled selected>Select a school</option>
                    @foreach ($schoolsList as $school)
                      <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : '' }}>
                        {{ $school->name }}</option>
                    @endforeach
                  </select>
                  @error('school_id')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div id="CNEField" style="display: none">
                <div class="row mb-3">
                  <label for="CNE" class="col-md-4 col-form-label text-md-end">CNE</label>
                  <div class="col-md-6">
                    <input id="CNE" type="text" class="form-control @error('CNE') is-invalid @enderror"
                      name="CNE" value="{{ old('CNE') }}" autocomplete="CNE">
                    @error('CNE')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="group_id" class="col-md-4 col-form-label text-md-end">{{ __('Group') }}</label>
                  <div class="col-md-6">
                    <select id="group_id" class="form-control @error('group_id') is-invalid @enderror" name="group_id">
                      <option value="" disabled selected>Select a group</option>
                      @foreach ($groupsList as $group)
                        <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>
                          {{ $group->name }}</option>
                      @endforeach
                    </select>
                    @error('group_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>


              <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="profilePicture" class="col-md-4 col-form-label text-md-end">Profile picture</label>
                <div class="col-md-6">
                  <input type="file" name="profilePicture" id="profilePicture"
                    class="form-control @error('profilePicture') is-invalid @enderror" required>
                  @error('profilePicture')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="password-confirm"
                  class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                    required autocomplete="new-password">
                </div>
              </div>

              <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      toggleCNEField();
    });

    function toggleCNEField() {
      var roleSelect = document.getElementById('idRole');
      var cneField = document.getElementById('CNEField');
      var selectedRole = roleSelect.options[roleSelect.selectedIndex].text;
      console.log(cneField);

      if (selectedRole === 'Student') {
        cneField.style.display = 'block';
      } else {
        cneField.style.display = 'none';
      }
    }
  </script>
@endsection

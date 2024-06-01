@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Hello {{ $user->firstName }}, welcome to your personal space,<br> {{ $user->role->name }} in
      {{ $user->school->name }}
      @if ($user->active == 0)
        <span class="text-danger"> ( Not activated )</span>
      @elseif ($user->active == 1)
        <span class="text-success"> ( Activated )</span>
      @endif
    </h1>

    <div class="d-flex justify-content-center mt-5">
      <div class="card col-8">
        <div class="card-header">
          Account details
        </div>
        <div class="card-body">
          <form action="{{ route('user.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-6">
                <div class="d-flex flex-column align-items-center">
                  <div class="mb-3">
                    <img src="/{{ $user->picture }}" alt="userProfile"
                      style="width: 100px; height: 100px; object-fit: cover;border-radius:50%" />
                  </div>
                  <div class="mb-3 w-100">
                    <label for="profilePicture" class="col-form-label text-md-end">Profile picture</label>
                    <input type="file" name="profilePicture" id="profilePicture"
                      class="form-control @error('profilePicture') is-invalid @enderror">
                    @error('profilePicture')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="firstName" class="col-form-label text-md-end">{{ __('First name') }}</label>
                  <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror"
                    name="firstName" value="{{ $user->firstName }}" autocomplete="firstName" autofocus>
                  @error('firstName')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="lastName" class="col-form-label text-md-end">{{ __('Last name') }}</label>
                  <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror"
                    name="lastName" value="{{ $user->lastName }}" autocomplete="lastName">
                  @error('lastName')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ $user->email }}" autocomplete="email">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" autocomplete="new-password">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="d-flex justify-content-between ">
                  <button type="submit" class="btn btn-primary ">Update</button>
                  <a class="btn btn-danger" href="/home" class="btn btn-primary">Cancel</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

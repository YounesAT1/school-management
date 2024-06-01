@extends('layouts.app')

@section('content')
  <div class="container-fluid p-0">
    <div class="d-flex justify-content-center">
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    </div>
    <div class="row justify-content-center m-0"
      style="height: 80vh; background-image:url('{{ asset('backround.jpg') }}'); display:flex; align-items:center;">
      <div class="col-md-6 d-flex flex-column align-items-center justify-content-center text-center"
        style="background-color: white; height:200px; border-radius:10px">

        <div>
          <h1 class="text-secondary fw-bold">Hello {{ Auth()->user()->firstName }}</h1>
          <h2 class="text-secondary fw-bold">Welcome to your personal space</h2>
        </div>
      </div>
    </div>
  </div>
@endsection

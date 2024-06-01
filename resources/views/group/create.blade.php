@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Add Group</div>
          <div class="card-body">
            <form action="{{ route('director.storeGroup') }}" method="POST" autocomplete="off">
              @csrf
              <div class="form-group mb-3">
                <label for="name">Group Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter group name"
                  value="{{ old('name') }}">
              </div>
              <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter group description"
                  value="{{ old('description') }}"></textarea>
              </div>
              <div>
                <button type="submit" class="btn btn-primary">Add</button>
                <a href="{{ route('director.showGroupsList') }}" class="btn btn-danger">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

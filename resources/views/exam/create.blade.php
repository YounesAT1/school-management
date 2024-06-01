@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Add Exam</div>
          <div class="card-body">
            <form action="{{ route('professor.storeExam') }}" method="POST" autocomplete="off">
              @csrf
              <div class="form-group mb-3">
                <label for="name">Exam Name</label>
                <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name"
                  name="name" placeholder="Enter exam name" value="{{ old('name') }}" required>
              </div>
              @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              <div class="form-group mb-3">
                <label for="mark">Mark</label>
                <input type="number" step="0.01" class="form-control  @error('mark') is-invalid @enderror"
                  id="mark" name="mark" placeholder="Enter exam mark" value="{{ old('mark') }}" required>
              </div>
              @error('mark')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              <div class="form-group mb-3">
                <label for="student_id">Student</label>
                <select class="form-control  @error('student_id') is-invalid @enderror" id="student_id" name="student_id"
                  required>
                  <option value="">Select a student</option>
                  @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->user->firstName }} {{ $student->user->lastName }}
                    </option>
                  @endforeach
                </select>
              </div>
              @error('student_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              <div class="form-group mb-3">
                <label for="module_id">Module</label>
                <select class="form-control  @error('module_id') is-invalid @enderror" id="module_id" name="module_id"
                  required>
                  <option value="">Select a module</option>
                  @foreach ($modules as $module)
                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                  @endforeach
                </select>
              </div>
              @error('module_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              <div>
                <button type="submit" class="btn btn-primary">Add</button>
                <a href="{{ route('professor.showExamsList') }}" class="btn btn-danger">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

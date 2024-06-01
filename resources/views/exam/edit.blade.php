@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Edit Exam with the ID : {{ $exam->id }}</div>
          <div class="card-body">
            <form action="{{ route('professor.updateExam', $exam) }}" method="POST" autocomplete="off">
              @csrf
              @method('PUT')
              <div class="form-group mb-3">
                <label for="name">Exam Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter exam name"
                  value="{{ old('name', $exam->name) }}" required>
              </div>
              <div class="form-group mb-3">
                <label for="mark">Mark</label>
                <input type="number" step="0.01" class="form-control" id="mark" name="mark"
                  placeholder="Enter exam mark" value="{{ old('mark', $exam->mark) }}" required>
              </div>
              <div class="form-group mb-3">
                <label for="student_id">Student</label>
                <select class="form-control" id="student_id" name="student_id" required>
                  <option value="">Select a student</option>
                  @foreach ($students as $student)
                    <option value="{{ $student->id }}"
                      {{ $student->id == old('student_id', $exam->student_id) ? 'selected' : '' }}>
                      {{ $student->user->firstName }} {{ $student->user->lastName }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group mb-3">
                <label for="module_id">Module</label>
                <select class="form-control" id="module_id" name="module_id" required>
                  <option value="">Select a module</option>
                  @foreach ($modules as $module)
                    <option value="{{ $module->id }}"
                      {{ $module->id == old('module_id', $exam->module_id) ? 'selected' : '' }}>
                      {{ $module->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('professor.showExamsList') }}" class="btn btn-danger">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

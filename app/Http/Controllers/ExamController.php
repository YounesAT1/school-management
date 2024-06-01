<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Group;
use App\Models\Module;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function showExamsList() {
        $professorSchoolId = Auth::user()->school->id;
        $groupIds = Group::where('school_id', $professorSchoolId)->pluck('id');
        $moduleIds = Module::whereIn('group_id', $groupIds)->pluck('id');
        $exams = Exam::whereIn('module_id', $moduleIds)->with('student.user')->get();
        return view('exam.examsList', compact('exams'));
    }

    public function createExam () {
        $professorSchoolId = Auth::user()->school->id;
        $groups = Group::where('school_id', $professorSchoolId)->get();
        $modules = Module::whereIn('group_id', $groups->pluck('id'))->get();
        $students = Student::whereIn('group_id', $groups->pluck('id'))
                        ->with('user')
                        ->get();

        return view('exam.create', compact('modules', 'students'));
    }

    public function storeExam (Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mark' => 'required|numeric|min:0',
            'student_id' => 'required|exists:students,id',
            'module_id' => 'required|exists:modules,id',
        ]);

        Exam::create($validatedData);
        return redirect()->route('professor.showExamsList')->with('success', 'Exam created successfully');
    }

    public function editExam (Exam $exam) {
        $professorSchoolId = Auth::user()->school->id;
        $groups = Group::where('school_id', $professorSchoolId)->get();
        $modules = Module::whereIn('group_id', $groups->pluck('id'))->get();
        $students = Student::whereIn('group_id', $groups->pluck('id'))
                        ->with('user')
                        ->get();
        return view('exam.edit', compact('exam', 'modules', 'students'));
    }

    public function updateExam (Request $request, Exam $exam) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mark' => 'required|numeric|min:0',
            'student_id' => 'required|exists:students,id',
            'module_id' => 'required|exists:modules,id',
        ]);

        $exam->update($validatedData);
        return redirect()->route('professor.showExamsList')->with('success', 'Exam updated successfully.');
    }

    public function destroyExam (Exam $exam){
        $exam->delete();
        return redirect()->route('professor.showExamsList')->with('success', 'Exam deleted successfully.');


    }
    
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class DirectorController extends Controller
{
    public function showDirectorsList() 
    {
        if (Auth::user()->role->name === "sysAdmin") {
            $directeursList = User::join('roles', 'users.idRole', '=', 'roles.idRole')
                ->where('roles.name', 'Director')
                ->get();
            return view("admin.directeursList", compact('directeursList'));
        } else {
            return redirect("/home");
        }
    }

    public function showProfessorsList()
    {
        if (Auth::user()->role->name === "Director") {
            $directorSchoolId = Auth::user()->school_id;

            $professorsList = User::select('users.id', 'users.firstName', 'users.lastName', 'users.email', 'users.active', 'schools.name as school_name', 'roles.name as role_name')
                                ->join('roles', 'users.idRole', '=', 'roles.idRole')
                                ->join('schools', 'users.school_id', '=', 'schools.id')
                                ->where('roles.name', 'Professor')
                                ->where('schools.id', $directorSchoolId)
                                ->get();
            return view("professor.professorsList", compact('professorsList'));
        } else {
            return redirect("/home");
        }
    }

    

    public function showStudentsList () {
        if (Auth::user()->role->name === "Director") {
            $directorSchoolId = Auth::user()->school_id; 
            $studentsList = User::join('roles', 'users.idRole', '=', 'roles.idRole')
                                ->join('schools', 'users.school_id', '=', 'schools.id')
                                ->join('students', 'users.id', '=', 'students.user_id')
                                ->where('roles.name', 'Student')
                                ->where('schools.id', $directorSchoolId) 
                                ->with('school', 'student')
                                ->get();
            
            return view("student.studentsList", compact('studentsList'));
        } else {
            return redirect("/home");
        }
    }

    public function deactivateStudentOrProfessor($id)
    {
        $studentOrProfessor = User::find($id);
        if ($studentOrProfessor) {
            $studentOrProfessor->active = 0;
            $studentOrProfessor->save();
            return redirect()->back()->with('success', 'User deactivated successfully');
        }
        return redirect()->back()->with('error', 'User not found');
    }

    public function activateStudentOrProfessor($id)
    {
        $studentOrProfessor = User::find($id);
        if ($studentOrProfessor) {
            $studentOrProfessor->active = 1;
            $studentOrProfessor->save();
            return redirect()->back()->with('success', 'User activated successfully');
        }
        return redirect()->back()->with('error', 'User not found');
    }

    

    
}

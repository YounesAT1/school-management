<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller
{

  protected function handleUploadPicture($file)
  {
      $folder = 'pictures';
      $token = uniqid();
      $pictureSrc = $folder . '/' . $token . '-' . $file->getClientOriginalName();
      $file->move(public_path($folder), $token . '-' . $file->getClientOriginalName());

      return $pictureSrc;
  }

  public function showSchoolsList() 
  {
      if (Auth::user()->role->name === "sysAdmin") {
          $schoolsList = School::all();
          return view("admin.schoolsList", compact('schoolsList'));
      } else {
          return redirect("/home");
      }
  }

  public function destroySchool(School $school) 
  {
      $school->delete();

      return redirect()->back()->with('success', 'School deleted successfully');
  }

  public function createSchool() 
  {
      return view('school.create');
  }

  public function storeSchool(Request $request)
  {
      $validatedData = $request->validate([
          'schoolName' => ['required', 'string', 'max:255'],
          'schoolAddress' => ['required', 'string', 'max:255'],
          'schoolPicture' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
      ]);

      $picturePath = $this->handleUploadPicture($request->file('schoolPicture'));

      School::create([
          'name' => $validatedData['schoolName'],
          'address' => $validatedData['schoolAddress'],
          'picture' => $picturePath,
      ]);

      return redirect()->route('admin.schoolsList')->with('success', 'School created successfully');
  }

  public function modifySchool(School $school) 
    {
        return view('school.update', compact('school'));
    }

  public function updateSchool(Request $request, School $school)
  {
      $validatedData = $request->validate([
          'schoolName' => ['required', 'string', 'max:255'],
          'schoolAddress' => ['required', 'string', 'max:255'],
          'schoolPicture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
      ]);

      if ($request->hasFile('schoolPicture')) {
          $validatedData['schoolPicture'] = $this->handleUploadPicture($request->file('schoolPicture'));
      } else {
          unset($validatedData['schoolPicture']);
      }

      $school->update([
          'name' => $validatedData['schoolName'],
          'address' => $validatedData['schoolAddress'],
          'picture' => $validatedData['schoolPicture'] ?? $school->picture,
      ]);

      return redirect()->route('admin.schoolsList')->with('success', 'School updated successfully');
  }

  public function schoolDetails(School $school)
  {
      $school->load('directors');
      return view('school.details', compact('school'));
  }


}

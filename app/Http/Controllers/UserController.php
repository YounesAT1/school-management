<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    protected function handleUploadPicture($file)
    {
        $folder = 'pictures';
        $token = uniqid();
        $pictureSrc = $folder . '/' . $token . '-' . $file->getClientOriginalName();
        $file->move(public_path($folder), $token . '-' . $file->getClientOriginalName());

        return $pictureSrc;
    }
    
    public function deactivateDirector($id)
    {
        $director = User::find($id);
        $director->active = 0;
        $director->save();
        return redirect()->back()->with('success', 'Director desactivated successfully');
    
    }

    public function activateDirector($id)
    {
        $director = User::find($id);
        $director->active = 1;
        $director->save();
        return redirect()->back()->with('success', 'Director activated successfully');
    
    }

    public function destroy(User $user, Student $student = null) 
    {
        $currentUser = Auth::user();
        if($currentUser->role->name === "Student"){
            $student->delete();
            return redirect()->back()->with('success', 'User deleted successfully');
        }else {
            $user->delete();
        }

        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function modifyUser(User $user) 
    {
        return view('user.update', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'firstName' => ['string', 'max:255'],
            'lastName' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['string', 'min:8', 'nullable'],
            'idRole' => ['string', 'max:255', 'exists:roles,idRole'],
            'profilePicture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'CNE' => ['required_if:idRole,Student', 'string', 'nullable']
        ]);

        if ($request->hasFile('profilePicture')) {
            $validatedData['profilePicture'] = $this->handleUploadPicture($request->file('profilePicture'));
            $user->picture = $validatedData['profilePicture'];
            $user->save();
        }

        if (empty($validatedData['password'])) {
            unset($validatedData['password']);
        } else {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        if ($request->idRole === 'Student') {
            if ($user->student) {
                $user->student->update(['CNE' => $validatedData['CNE']]);
            } else {
                Student::create(['user_id' => $user->id, 'CNE' => $validatedData['CNE']]);
            }
        }

        return redirect()->route('home')->with('success', 'User details updated successfully');
    }

    
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use App\Models\School;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegister()
    {
        $rolesList = Role::all();
        $schoolsList = School::all();
        $groupsList = Group::all();
        return view('auth.register', ['rolesList' => $rolesList, 'schoolsList' => $schoolsList, 'groupsList' => $groupsList]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'idRole' => ['required', 'string', 'nullable'],
            'school_id' => ['required'],
            'profilePicture' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'CNE' => ['required_if:idRole,3', 'string', 'nullable'],
            'group_id' => ['required_if:idRole,3', 'string', 'nullable'],
        ]);
    }

    /**
     * Handle the profile picture upload.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @return string
     */
    protected function handleUploadPicture($file)
    {
        $folder = 'pictures';
        $token = uniqid();
        $pictureSrc = $folder . '/' . $token . '-' . $file->getClientOriginalName();
        $file->move(public_path($folder), $token . '-' . $file->getClientOriginalName());

        return $pictureSrc;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $profilePictureSrc = $this->handleUploadPicture(request()->file('profilePicture'));
        $role = Role::where('idRole', $data['idRole'])->firstOrFail();
        
        $user = User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'idRole' => $data['idRole'],
            'password' => Hash::make($data['password']),
            'picture' => $profilePictureSrc,
            'active' => 0,
            'school_id' => $data['school_id']
        ]);
        if ($role->name === 'Student') {
            Student::create([
                'user_id' => $user->id,
                'CNE' => $data['CNE'],
                'group_id' => $data['group_id'],
            ]);
        }

        return $user;
    }
}

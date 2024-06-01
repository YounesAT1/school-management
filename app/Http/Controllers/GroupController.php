<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function showGroupsList () {

        $schoolId = Auth::user()->school_id;

        $groupsList = Group::where('school_id', $schoolId)->get();
        return view('group.groupsList', compact('groupsList'));
    }

    public function destroyGroup(Group $group) {
        $schoolId = Auth::user()->school_id;
        $userRole = Auth::user()->role->name;
    
        if ($userRole === 'Director' && Auth::user()->active === 1) { 
            if ($group->school_id == $schoolId) {
                $group->delete();
                return back()->with('success', 'Group deleted successfully');
            }
    
            return back()->with('error', 'You do not have permission to delete this group');
        }
    
        return back()->with('error', 'You do not have permission to delete this group');
    }


    public function createGroup () {
        return view('group.create');
    }

    public function storeGroup (Request $request) {

        $schoolId = Auth::user()->school_id;


        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Group::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'school_id' => $schoolId,
        ]);

        return redirect()->route('director.showGroupsList')->with('success', 'Group created successfully');
    }

    public function editGroup (Group $group){
        return view('group.edit', compact('group'));
    }

    public function updategroup(Request $request, Group $group){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $group->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description']
        ]);

        return redirect()->route('director.showGroupsList')->with('success', 'Group updated successfully');
    }
}

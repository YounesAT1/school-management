<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Module;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function showModulesList () {
        $schoolId = Auth::user()->school_id;
        
        $optionID = Option::where('school_id', $schoolId)->value('id');
    
        $modulesList = Module::where('option_id', $optionID)->get();
    
        return view('module.modulesList', compact('modulesList'));
    }
    

    public function createModule () {
        $schoolId = Auth::user()->school_id;

        $optionsList = Option::where('school_id', $schoolId)->get();
        $groupsList = Group::where('school_id', $schoolId)->get();

        return view('module.create', ['optionsList'=>$optionsList, 'groupsList'=>$groupsList]);
    }

    public function storeModule (Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'numberOfHours' => ['required', 'integer'],
            'option_id' => ['required', 'exists:options,id'],
            'group_id' => ['required', 'exists:groups,id']
        ]);
        
        
        Module::create([
            'name' =>$validatedData['name'],
            'numberOfHours' =>$validatedData['numberOfHours'],
            'option_id' => $validatedData['option_id'],
            'group_id' => $validatedData['group_id']

        ]);

        return redirect()->route('director.showModulesList')->with('success', 'Module created successfully');

    }

    public function editModule (Module $module) {
        $schoolId = Auth::user()->school_id;

        $optionsList = Option::where('school_id', $schoolId)->get();
        $groupsList = Group::where('school_id', $schoolId)->get();

        return view('module.edit', ['optionsList' => $optionsList, 'groupsList' => $groupsList, 'module' => $module]);
    }

    public function updateModule(Request $request, Module $module)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'numberOfHours' => ['required', 'integer'],
            'option_id' => ['required', 'exists:options,id'],
            'group_id' => ['required', 'exists:groups,id']
        ]);

        $module->update($validatedData);

        return redirect()->route('director.showModulesList')->with('success', 'Module updated successfully');
    }

    public function destroyModule (Module $module) {
        $module->delete();
        return redirect()->route('director.showModulesList')->with('success', 'Module deleted successfully');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class OptionController extends Controller
{
   public function showOptionsList () {
        $schoolId = Auth::user()->school_id;

        $optionsList = Option::where('school_id', $schoolId)->get();
        return view('option.optionList', compact('optionsList'));
   }

   public function createOption () {
    return view('option.create');
   }

   public function storeOption (Request $request) {
    $schoolId = Auth::user()->school_id;

     $validatedData = $request->validate([
        'name' => 'required|string'
     ]);

     Option::create([

        'name'=>$validatedData['name'],
        'school_id' => $schoolId
     ]);

     return redirect()->route('director.showOptionsList')->with('success', 'Option created successfully');

   }

   public function editOption (Option $option) {
    return view('option.edit', compact('option'));
   }

    public function updateOption(Request $request, Option $option){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $option->update([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('director.showOptionsList')->with('success', 'Option updated successfully');
    }

    public function destroyOption(Option $option) {
        $schoolId = Auth::user()->school_id;
        $userRole = Auth::user()->role->name;
    
        if ($userRole === 'Director' && Auth::user()->active === 1) { 
            if ($option->school_id == $schoolId) {
                $option->delete();
                return back()->with('success', 'Option deleted successfully');
            }
    
            return back()->with('error', 'You do not have permission to delete this Option');
        }
    
        return back()->with('error', 'You do not have permission to delete this Option');
    }
}

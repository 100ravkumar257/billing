<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hierarchy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class HierarchyController extends Controller
{

    public function create()
    {
       
        // $parents =                                                                                                                                                                 ::where('parent_id', 1)->get();
        // // dd($parents); 
        // // exit;
        // return view('admin.hierarchy.create', compact('parents'));
        $parents = Hierarchy::all(); 
        // dd($parents); 
        return view('admin.hierarchy.create', compact('parents'));
        
    }

    public function store(Request $request)
    {
 
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'required|integer',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Hierarchy::create($validated);

        return redirect()->route('hierarchy.create')->with('success', 'Hierarchy created successfully');
    }
}

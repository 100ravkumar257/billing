<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tbl_user;
use App\Models\Hierarchy;

class Tbl_userController extends Controller
{
    public function create()
    {
        $roles = Hierarchy::distinct('name')->pluck('name');

        $parents = Hierarchy::where('parent_id', 1)->get();
        //    dd($parents); 

        return view('admin.product_variants.create', compact('roles', 'parents'));
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'required|integer',
            'status' => 'required|in:active,inactive',
            'role_id' => 'required|string', 
        ]);

        $roleId = Hierarchy::where('name', $validated['role_id'])->first();
    
        if (!$roleId) {
            return redirect()->route('tbl_user.create')->with('error', 'Role not found.');
        }
   
        $validated['role_id'] = $roleId->id;
    
        Tbl_user::create($validated);
    
        return redirect()->route('tbl_user.create')->with('success', 'User created successfully');
    }

    // public function getParentsByRole($roleName)
    // {
    //     $parents = Hierarchy::where('name', $roleName)->where('parent_id', )->get();

    //     return response()->json($parents);
    // }
}

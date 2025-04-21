<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\User; 
use Exception;

class RoleController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:role-list', ['only' => ['index','store']]);
		$this->middleware('permission:role-create', ['only' => ['create','store']]);
		$this->middleware('permission:role-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:role-delete', ['only' => ['destroy']]);

        $role_list = Permission::get()->filter(function($item) {
            return $item->name == 'role-list';
        })->first();
        $role_create = Permission::get()->filter(function($item) {
            return $item->name == 'role-create';
        })->first();
        $role_edit = Permission::get()->filter(function($item) {
            return $item->name == 'role-edit';
        })->first();
        $role_delete = Permission::get()->filter(function($item) {
            return $item->name == 'role-delete';
        })->first();


        if ($role_list == null) {
            Permission::create(['name'=>'role-list']);
        }
        if ($role_create == null) {
            Permission::create(['name'=>'role-create']);
        }
        if ($role_edit == null) {
            Permission::create(['name'=>'role-edit']);
        }
        if ($role_delete == null) {
            Permission::create(['name'=>'role-delete']);
        }
	}

	public function index(Request $request)
	{
		// $roles = Role::leftJoin('roles as parent_roles', 'roles.parent_id', '=', 'parent_roles.id')
		// 	->select('roles.*', 'parent_roles.name as parent_name') 
		// 	->get();
            $roles = Role::leftJoin('roles as parent_roles', 'roles.parent_id', '=', 'parent_roles.id')
			->select('roles.*', 'parent_roles.name as parent_name') 
			->get();
	
		return view('admin.roles.index', compact('roles'));
	}
	
	public function create()
	{
		$roles = Role::all();
		$permissions = Permission::get();
		return view('admin.roles.create',compact('permissions','roles'));
	}

	public function store(Request $request)
	{
		$rules = [
            'name' 					=> 'required|unique:roles,name',
            'code' 					=> 'required|unique:roles,code',
            'status'                => 'required|boolean',
			'permission' 			=> 'required',
        ];

        $messages = [
            'name.required'    		=> __('default.form.validation.name.required'),
            'name.unique'    		=> __('default.form.validation.name.unique'),
            'code.required'    		=> __('default.form.validation.code.required'),
            'code.unique'    		=> __('default.form.validation.code.unique'),
            'status.required'       => __('default.form.validation.status.required'),
            'permission.required'   => __('default.form.validation.permission.required'),
        ];
        
        $this->validate($request, $rules, $messages);
       
		try {
            $role = Role::create([
                'name' => $request->input('name'), 
                'code' => $request->input('code'),
                'parent_id' => $request->input('parent_id'),
                'status' => $request->input('status'),
            ]);
			$role->syncPermissions($request->input('permission'));

            Toastr::success(__('role.message.store.success'));
		    return redirect()->route('roles.index');
		} catch (Exception $e) {
            Toastr::error(__('role.message.store.error'));
		    return redirect()->route('roles.index');
		} 
	}

	public function edit($id)
	{
        $role = Role::find($id);
        $permissions = Permission::all();
        $roles = Role::where('id', '!=', $id)->get(); 

		return view('admin.roles.edit',compact('role','permissions','roles'));
	}
    

	// public function update(Request $request, $id)
	// {
	// 	$rules = [
    //         'name' 					=> 'required|unique:roles,name,' . $id,
    //         'code' 					=> 'required|unique:roles,code,' . $id,
	// 		'permission' 			=> 'required',
    //     ];

    //     $messages = [
    //         'name.required'    		=> __('default.form.validation.name.required'),
    //         'name.unique'    		=> __('default.form.validation.name.unique'),
    //         'code.required'    		=> __('default.form.validation.code.required'),
    //         'code.unique'    		=> __('default.form.validation.code.unique'),
    //         'permission.required'   => __('default.form.validation.permission.required'),
    //     ];
        
    //     $this->validate($request, $rules, $messages);

    //     try {
	// 		$role = Role::find($id);
	// 		$role->name = $request->input('name');
	// 		$role->code = $request->input('code');
    //         // 'parent_id' => $request->input('parent_id')
	// 		$role->save();
	// 		$role->syncPermissions($request->input('permission'));

    //         Toastr::success(__('role.message.update.success'));
	// 	    return redirect()->route('roles.index');
	// 	} catch (Exception $e) {
    //         Toastr::error(__('role.message.update.error'));
	// 	    return redirect()->route('roles.index');
	// 	}
	// }
    public function update(Request $request, $id)
{
    $rules = [
        'name' => 'required|unique:roles,name,' . $id,
        'code' => 'required|unique:roles,code,' . $id,
        'status' => 'required|boolean',
        'permission' => 'required',
    ];

    $messages = [
        'name.required' => __('default.form.validation.name.required'),
        'name.unique' => __('default.form.validation.name.unique'),
        'code.required' => __('default.form.validation.code.required'),
        'code.unique' => __('default.form.validation.code.unique'),
        'status.required'       => __('default.form.validation.status.required'),
        'permission.required' => __('default.form.validation.permission.required'),
    ];

    $this->validate($request, $rules, $messages);

    try {
        $role = Role::findOrFail($id);

        $role->update([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'parent_id' => $request->input('parent_id'),
            'status' => $request->input('status'),
        ]);

        $role->syncPermissions($request->input('permission'));
        Toastr::success(__('role.message.update.success'));
        return redirect()->route('roles.index');
    } catch (Exception $e) {
        Toastr::error(__('role.message.update.error'));
        return redirect()->route('roles.index');
    }
}
	public function destroy()
	{
		$id = request()->input('id');
		$allrole = Role::all();
		$countallrole = $allrole->count();

		if ($countallrole <= 1) {
			Toastr::error(__('role.message.warning_last_role'));
		    return redirect()->route('users.index');
		}else{
			$getrole = Role::find($id);
			try {
				Role::find($id)->delete();
				return back()->with(Toastr::error(__('role.message.destroy.success')));
			} catch (Exception $e) {
				$error_msg = Toastr::error(__('user.message.destroy.error'));
				return redirect()->route('roles.index')->with($error_msg);
			}
		}
	}


public function getParentRole($roleName)
{
    $role = Role::where('name', $roleName)->first();
    if ($role && $role->parent_id) {
        $parentUser = User::find($role->parent_id);

        if ($parentUser) {
            return response()->json(['parent_id' => $parentUser->id, 'parent_name' => $parentUser->name]);
        } else {
            return response()->json(['parent_id' => null, 'parent_name' => 'No Parent']);
        }
    } else {
        return response()->json(['parent_id' => null, 'parent_name' => 'No Parent']);
    }
}
public function status_update(Request $request)
{
    $role = Role::findOrFail($request->id);
    $role->update(['status' => $request->status]);

    $message = $request->status == 1 ? 'Role activated successfully.' : 'Role deactivated successfully.';
    return response()->json(['message' => $message]);
}


}

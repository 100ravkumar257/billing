<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Image;
use Storage;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:user-list', ['only' => ['index', 'store']]);
		$this->middleware('permission:user-create', ['only' => ['create', 'store']]);
		$this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
		$this->middleware('permission:user-delete', ['only' => ['destroy']]);
		$this->middleware('permission:profile-index', ['only' => ['profile', 'profile_update']]);

		$user_list = Permission::get()->filter(function ($item) {
			return $item->name == 'user-list';
		})->first();
		$user_create = Permission::get()->filter(function ($item) {
			return $item->name == 'user-create';
		})->first();
		$user_edit = Permission::get()->filter(function ($item) {
			return $item->name == 'user-edit';
		})->first();
		$user_delete = Permission::get()->filter(function ($item) {
			return $item->name == 'user-delete';
		})->first();
		$profile_index = Permission::get()->filter(function ($item) {
			return $item->name == 'profile-index';
		})->first();


		if ($user_list == null) {
			Permission::create(['name' => 'user-list']);
		}
		if ($user_create == null) {
			Permission::create(['name' => 'user-create']);
		}
		if ($user_edit == null) {
			Permission::create(['name' => 'user-edit']);
		}
		if ($user_delete == null) {
			Permission::create(['name' => 'user-delete']);
		}
		if ($profile_index == null) {
			Permission::create(['name' => 'profile-index']);
		}
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = User::get();
			return Datatables::of($data)
				->addIndexColumn()
				->addColumn('action', function ($row) {
					if (Gate::check('user-edit')) {
						$edit = '<a href="' . route('users.edit', $row->id) . '" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i>
                                        
                                </a>';
					} else {
						$edit = '';
					}
					if (Gate::check('user-delete')) {
						$delete = '<button class="custom-delete-btn remove-user" data-id="' . $row->id . '" data-action="' . route('users.destroy') . '">
										<i class="fe fe-trash"></i>
		                              
									</button>';
					} else {
						$delete = '';
					}
					$action = $edit . ' ' . $delete;
					return $action;
				})

				->addColumn('status', function ($row) {
					if ($row->status == 1) {
						$current_status = 'Checked';
					} else {
						$current_status = '';
					}
					$status = "
                            <input type='checkbox' id='status_$row->id' id='user-$row->id' class='check' onclick='changeUserStatus(event.target, $row->id);' " . $current_status . ">
							<label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";
					return $status;
				})

				->addColumn('image', function ($row) {
					if ($row->image == null or empty($row->image)) {
						$image = '<img src="public/assets/admin/img/default-user.png" class="w-50 rounded-circle img-fluid img-thumbnail" style="max-width: 50px;">';
					} else {
						$image = '<img src="' . $row->image . '" class="w-50 rounded-circle img-fluid img-thumbnail" style="max-width: 60px; height: 45px;">';
					}
					return $image;
				})

				->rawColumns(['action', 'image'])

				->addColumn('role', function ($user) {
					$role = str_replace(array('[', ']'), '', $user->getRoleNames());
					return $role = str_replace(array('"'), ' ', $role);
				})

				->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
				->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
				->escapeColumns([])
				->make(true);
		}
		return view('admin.users.index');
	}

	// public function create()
	// {
	// 	// $parents = Role::all(); 
	// 	$roles = Role::all();
	// 	return view('admin.users.create',compact('roles','parents'));
	// 	// $parents = Role::all(); 
	//     // dd($roles); 
	//     // return view('admin.hierarchy.create', compact('parents'));

	// }
	public function create()
	{
		$roles = Role::all();
		// $users = User::whereNull('parent_id')->get();
		$users = Role::leftJoin('roles as parent_roles', 'roles.parent_id', '=', 'parent_roles.id')
			->select('roles.*', 'parent_roles.name as parent_name')
			->get();

		return view('admin.users.create', compact('roles', 'users'));
	}



// 	public function store(Request $request){
//     $rules = [
//         'name' => 'required',
//         'email' => 'required|email|unique:users,email',
//         'password' => 'required|same:confirm-password',
//         'roles' => 'required',
//         'mobile' => 'required|string|unique:users,mobile',
//         'image' => 'nullable',
//         'parent_id' => 'nullable|exists:users,id', approver
//     ];

//     $messages = [
//         'name.required' => __('default.form.validation.name.required'),
//         'email.required' => __('default.form.validation.email.required'),
//         'email.email' => __('default.form.validation.email.email'),
//         'email.unique' => __('default.form.validation.email.unique'),
//         'password.required' => __('default.form.validation.password.required'),
//         'password.same' => __('default.form.validation.password.same'),
//         'roles.required' => __('default.form.validation.roles.required'),
//         'mobile.required' => __('default.form.validation.mobile.required'),
//         'parent_id.exists' => __('default.form.validation.parent_id.exists'),
//     ];

//     $this->validate($request, $rules, $messages);

   
//     $input = $request->all();
//     $input['password'] = Hash::make($input['password']);
//     if ($request->has('parent_id')) {
//         $input['parent_id'] = $request->input('parent_id');
//     }
     
//     try {
//         $user = User::create($input);
//         if ($request->roles) {
//             $user->assignRole($request->input('roles'));
//         }

//         Toastr::success(__('user.message.store.success'));
//         return redirect()->route('users.index');

//     } catch (Exception $e) {
//         Toastr::error(__('user.message.store.error'));
//         return redirect()->route('users.index');
//     }
// }
public function store(Request $request)
{
    $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:confirm-password',
        'roles' => 'required',
        'mobile' => 'required|string|unique:users,mobile',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        'parent_id' => 'nullable|exists:users,id', 
        'approver' => 'required|in:yes,no', 
    ];

    $messages = [
        'name.required' => __('default.form.validation.name.required'),
        'email.required' => __('default.form.validation.email.required'),
        'email.email' => __('default.form.validation.email.email'),
        'email.unique' => __('default.form.validation.email.unique'),
        'password.required' => __('default.form.validation.password.required'),
        'password.same' => __('default.form.validation.password.same'),
        'roles.required' => __('default.form.validation.roles.required'),
        'mobile.required' => __('default.form.validation.mobile.required'),
        'mobile.unique' => __('default.form.validation.mobile.unique'),
        'image.image' => __('default.form.validation.image.image'), 
        'image.mimes' => __('default.form.validation.image.mimes'),
        'image.max' => __('default.form.validation.image.max'),
        'parent_id.exists' => __('default.form.validation.parent_id.exists'),
        'approver.required' => __('default.form.validation.approver.required'),
        'approver.in' => __('default.form.validation.approver.in'),
    ];

    $this->validate($request, $rules, $messages);

    $input = $request->all();
    $input['approver'] = $request->input('approver') === 'yes' ? 1 : 0;
    $input['password'] = Hash::make($input['password']);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $path = $image->store('user_images', 'public'); 
        $input['image'] = $path;
    }
    if ($request->has('parent_id') && $request->input('parent_id')) {
        $input['parent_id'] = $request->input('parent_id');
    }
    try {
        $user = User::create($input);

        if ($request->has('roles')) {
            $user->assignRole($request->input('roles'));
        }
        Toastr::success(__('user.message.store.success'));
        return redirect()->route('users.index'); 
    } catch (Exception $e) {
        Toastr::error(__('user.message.store.error'));
        return redirect()->route('users.index');
    }
}

public function edit($id)
{
	$roles = Role::all();
    $user = User::leftJoin('roles as parent_roles', 'users.parent_id', '=', 'parent_roles.id')
        ->select('users.*', 'parent_roles.name as parent_name')  
        ->where('users.id', $id) 
        ->first();  

    return view('admin.users.edit', compact( 'roles','user'));
}

	public function update(Request $request, $id)
	{
		$rules = [
			'name' => 'required',
			'email' => 'required|email|unique:users,email,' . $id,
			'password' => 'nullable|same:confirm-password',
			'roles' => 'required',
			'mobile' => 'required|string|unique:users,mobile,' . $id,
			'image' => 'nullable|image',
			'parent_id' => 'nullable|exists:users,id',
			'approver' => 'required|in:yes,no',  
		];
	
		$messages = [
			'name.required' => __('default.form.validation.name.required'),
			'email.required' => __('default.form.validation.email.required'),
			'email.email' => __('default.form.validation.email.email'),
			'email.unique' => __('default.form.validation.email.unique'),
			'password.same' => __('default.form.validation.password.same'),
			'roles.required' => __('default.form.validation.roles.required'),
			'mobile.required' => __('default.form.validation.mobile.required'),
			'parent_id.exists' => __('default.form.validation.parent_id.exists'),
			'approver.required' => __('default.form.validation.approver.required'),
			'approver.in' => __('default.form.validation.approver.in'),
		];
	
		$this->validate($request, $rules, $messages);
	
		$input = $request->all();
		$input['approver'] = $request->input('approver') === 'yes' ? 1 : 0;
		$user = User::findOrFail($id);

		if (empty($input['image'])) {
			$input['image'] = $user->image;
		}

		if (!empty($input['password'])) {
			$input['password'] = Hash::make($input['password']);
		} else {
			$input['password'] = $user->password;
		}
		if ($request->has('parent_id') && $request->input('parent_id')) {
			$input['parent_id'] = $request->input('parent_id');
		}
		try {
			$user->update($input);
			$user->roles()->detach();
			if ($request->roles) {
				$user->assignRole($request->input('roles'));
			}
	
			Toastr::success(__('user.message.update.success'));
			return redirect()->route('users.index');
		} catch (Exception $e) {
			Toastr::error(__('user.message.update.error'));
			return redirect()->route('users.index');
		}
	}
	

	public function destroy()
	{
		$id = request()->input('id');
		$all_user = User::all();
		$count_all_user = $all_user->count();

		if ($count_all_user <= 1) {
			Toastr::error(__('user.message.warning_last_user'));
			return redirect()->route('users.index');
		} else {
			$getuser = User::find($id);
			if (!empty($getuser->image)) {
				$image_path = 'storage/' . $getuser->image;
				if (File::exists($image_path)) {
					File::delete($image_path);
				}
			}
			try {
				User::find($id)->delete();
				return back()->with(Toastr::error(__('user.message.destroy.success')));
			} catch (Exception $e) {
				$error_msg = Toastr::error(__('user.message.destroy.error'));
				return redirect()->route('users.index')->with($error_msg);
			}
		}
	}

	public function profile()
	{
		return view('admin.users.profile');
	}

	public function profile_update(Request $request, $id)
	{
		$rules = [
			'password' => 'required|string|min:6|same:confirm-password',
		];

		$messages = [
			'password.required' => __('default.form.validation.password.required'),
			'password.same' => __('default.form.validation.password.same'),
		];

		$this->validate($request, $rules, $messages);
		$input = $request->all();
		$input['password'] = Hash::make($input['password']);

		try {
			$user = User::whereId($id)->update([
				'password' => $input['password']
			]);

			Toastr::success(__('user.message.profile.success'));
			return redirect()->route('profile');
		} catch (Exception $e) {
			Toastr::success(__('user.message.profile.error'));
			return redirect()->route('profile');
		}
	}

	public function status_update(Request $request)
	{
		$user = User::find($request->id)->update(['status' => $request->status]);

		if ($request->status == 1) {
			return response()->json(['message' => 'Status activated successfully.']);
		} else {
			return response()->json(['message' => 'Status deactivated successfully.']);
		}
	}

	public function getParentUsersByRole(Request $request)
	{
		$roles = Role::where('id', $request->role)->first();
		
		$role_id = $roles->parent_id;
		

		$modelIds = DB::table('model_has_roles')
    ->where('role_id', $role_id)
    ->pluck('model_id'); 

// Optionally, if you need to fetch specific models (like User models) related to these model_ids:
$users = User::whereIn('id', $modelIds)->get();

		return response()->json([			
			'status'=>200,
			'data' => $users,
		]);
	}
	// public function getParentUsersByRole(Request $request)
// {
//     $role = $request->input('role');

	//     // Assuming you have a relationship between User and Role
//     $users = User::whereHas('roles', function($query) use ($role) {
//         $query->where('name', $role);
//     })->get(['id', 'name']);  // Get only id and name fields

	//     return response()->json([
//         'users' => $users
//     ]);
// }

}

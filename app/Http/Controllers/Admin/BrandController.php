<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Spatie\Permission\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function __construct()
    { 
        $this->middleware('auth');
        $this->middleware('permission:brand-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:brand-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:brand-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:brand-delete', ['only' => ['destroy']]);

        // Create necessary permissions if not exist
        $permissions = ['brand-list', 'brand-create', 'brand-edit', 'brand-delete'];
        foreach ($permissions as $perm) {
            if (Permission::where('name', $perm)->doesntExist()) {
                Permission::create(['name' => $perm]);
            }
        }
    }

// List all brands
public function index(Request $request)
{
    if ($request->ajax()) {
       
        $data = Brand::orderBy('name', 'asc')->get();

        return Datatables::of($data)
            ->addIndexColumn() 
            ->addColumn('action', function ($row) {
               
                $edit = Gate::allows('brand-edit') ? 
                    '<a href="' . route('brands.edit', $row->id) . '" class="custom-edit-btn mr-1"><i class="fe fe-pencil"></i></a>' : '';
                $delete = Gate::allows('brand-delete') ? 
                    '<button class="custom-delete-btn remove-brand" data-id="' . $row->id . '" data-action="' . route('brands.destroy') . '"><i class="fe fe-trash"></i></button>' : '';

                return $edit . ' ' . $delete;
            })
            ->addColumn('status', function($row) {
              
                $current_status = $row->status == 1 ? 'checked' : '';
                
               
                $status = "
                    <input type='checkbox' id='status_$row->id' class='check' onclick='changeBrandStatus(event.target, $row->id);' $current_status>
                    <label for='status_$row->id' class='checktoggle'>checkbox</label>
                ";
                return $status;
            })
            ->editColumn('created_at', '{{ date("jS M Y", strtotime($created_at)) }}') 
            ->rawColumns(['action', 'status']) 
            ->make(true); 
    }

    return view('admin.brands.index');
}


    // Show form to create brand
    public function create()
    {
        return view('admin.brands.create'); 
    }

    // Store new brand
    // public function store(Request $request)
    // {
    //     //dd($request->all());
    //     $rules = [
    //         'name' => 'required|unique:brands,name',
    //         'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ];
    //     $messages = [
    //         'name.required'  => __('brands.form.validation.name.required'),
    //         'image.image'      => __('default.form.validation.image.image'),
    //         'image.mimes'      => __('default.form.validation.image.mimes'),
    //         'image.max'        => __('default.form.validation.image.max'),
    //     ];

   
    //         $slug = Str::slug($request->name, '-');
    //         $this->validate($request, $rules, $messages);
    //         try {
    //             $data = $request->all();
    //         if ($request->hasFile('image')) {
    //             $image = $request->file('image');
    //             if ($image->isValid()) {  
    //                 $imageName = time() . '.' . $image->getClientOriginalExtension();
    //                 $image->storeAs('public/brands', $imageName); 
    //                 $data['image'] = $imageName; 
    //             }
    //         }
    //         Brand::create([
    //             'name' => $request->name,
    //             'slug' => $slug,
    //             'status' => $request->status
                
    //         ]);
    //         Toastr::success(__('brands.message.store.success'));
    //         return redirect()->route('brands.index');
    //     } catch (\Exception $e) {
    //         Toastr::error(__('brands.message.store.error'));
    //         return redirect()->route('brands.index');
    //     }
    // }
    public function store(Request $request)
{
    $rules = [
        'name' => 'required|unique:brands,name',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    $messages = [
        'name.required'  => __('brands.form.validation.name.required'),
        'image.image' => __('default.form.validation.image.image'),
        'image.mimes' => __('default.form.validation.image.mimes'),
        'image.max' => __('default.form.validation.image.max'),
    ];

    $slug = Str::slug($request->name, '-');
    $this->validate($request, $rules, $messages);

    try {
        $data = [
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status,
        ];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/brands', $imageName);
                $data['image'] = $imageName;
            }
        }
        Brand::create($data);
        Toastr::success(__('brands.message.store.success'));
        return redirect()->route('brands.index');
    } catch (\Exception $e) {
        Toastr::error(__('brands.message.store.error'));
        return redirect()->route('brands.index');
    }
}

    public function edit($id)
    {
        $row = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('row'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:brands,name,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        try {
            $brand = Brand::findOrFail($id);
            $slug = Str::slug($request->name, '-');
            $data = [
                'name' => $request->name,
                'slug' => $slug,
                'status' => $request->status
            ];
            if ($request->hasFile('image')) {
                if ($brand->image) {
                    $oldImagePath = public_path('storage/brands/' . $brand->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $image = $request->file('image');
                if ($image->isValid()) {
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/brands', $imageName);
                    $data['image'] = $imageName;
                }
            }
            $brand->update($data);
            Toastr::success(__('brands.message.update.success'));
            return redirect()->route('brands.index');
        } catch (\Exception $e) {
            Toastr::error(__('brands.message.update.error'));
            return redirect()->route('brands.index');
        }
    }

    // Delete brand
    public function destroy(Request $request)
    {
        try {
            $brand = Brand::findOrFail($request->id);
            $brand->delete();
            Toastr::success(__('brands.message.destroy.success'));
            return redirect()->route('brands.index');
        } catch (\Exception $e) {
            Toastr::error(__('brands.message.destroy.error'));
            return redirect()->route('brands.index');
        }
    }

    // Update brand status
    public function status_update(Request $request)
    {
        $brand = Brand::find($request->id)->update(['status' => $request->status]);

        if ($request->status == 1) {
            return response()->json(['message' => 'Brand activated successfully.']);
        } else {
            return response()->json(['message' => 'Brand deactivated successfully.']);
        }
    }
}


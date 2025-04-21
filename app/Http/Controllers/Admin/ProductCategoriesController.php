<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Spatie\Permission\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ProductCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:categories-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:categories-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:categories-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:categories-delete', ['only' => ['destroy']]);

        // Create necessary permissions if not exist
        $permissions = ['categories-list', 'categories-create', 'categories-edit', 'categories-delete'];
        foreach ($permissions as $perm) {
            if (Permission::where('name', $perm)->doesntExist()) {
                Permission::create(['name' => $perm]);
            }
        }
    }

    // List all categories
    public function index(Request $request)
    {
       
        if ($request->ajax()) {
            $data = ProductCategory::orderBy('name', 'asc')->get();
            return Datatables::of($data)
            
                ->addIndexColumn()
                
                ->addColumn('action', function ($row) {
                    $edit = Gate::allows('category-edit') ? '<a href="'.route('categories.edit', $row->id).'" class="custom-edit-btn mr-1"><i class="fe fe-pencil"></i></a>' : '';
                    $delete = Gate::allows('category-delete') ? '<button class="custom-delete-btn remove-category" data-id="'.$row->id.'" data-action="'.route('categories.destroy').'"><i class="fe fe-trash"></i></button>' : '';
                    return $edit . ' ' . $delete;
                })
                ->addColumn('status', function($row) {
                   
                    $current_status = $row->status == 1 ? 'checked' : '';
                    
                    $status = "
                        <input type='checkbox' id='status_$row->id' class='check' onclick='changeCategoryStatus(event.target, $row->id);' $current_status>
                        <label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";
                    return $status;
                })
                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
                ->rawColumns(['action', 'status']) 
                ->make(true);
                
        }
        
        return view('admin.categories.index');
      
    }
    

    // Show form to create category
    public function create()
    {   
        $categories = ProductCategory::where('parent_category', 0)->get();
        return view('admin.categories.create', compact('categories'));
    }

    // Store new category
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|unique:product_categories,name',
    //     ]);

    //     $messages = [
    //         'name.required'  => __('productcategories.form.validation.name.required'),
    //     ];

    //     try {
    //         $parentCategoryId = $request->parent_category ? $request->parent_category : 0;
    //         $slug = Str::slug($request->name, '-');
    //         ProductCategory::create(['name' => $request->name, 'parent_id' => $parentCategoryId, 'slug' => $slug, 'status' => $request->status ] );
    //         Toastr::success(__('productcategories.message.store.success'));
    //         return redirect()->route('categories.index');
    //     } catch (\Exception $e) {
    //         Toastr::error(__('productcategories.message.store.error'));
    //         return redirect()->route('categories.index');
    //     }
    // }
    public function store1(Request $request)
    {
        $rules = [
            'name'      => 'required|string|unique:product_categories,name',
            'slug'      => 'nullable|string|unique:product_categories,slug',
            'status'    => 'required|boolean',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $messages = [
            'name.required'    => 'Category name is required.',
            'name.unique'      => 'Category name must be unique.',
            'slug.unique'      => 'Slug must be unique.',
            'status.required'  => 'Status is required.',
            'image.image'      => 'File must be an image.',
            'image.mimes'      => 'Allowed image types: jpeg, png, jpg, gif, svg.',
            'image.max'        => 'Maximum image size is 2MB.',
        ];

        $this->validate($request, $rules, $messages);

        try {
            $data = $request->all();
            $data['parent_category'] = $request->parent_category ?? 0;
            $data['slug'] = $request->slug ?: Str::slug($request->name, '-');

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                if ($image->isValid()) {
                    $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/categories', $imageName); // stored in storage/app/public/categories
                    $data['image'] = 'storage/categories/' . $imageName; // this will be used to access via public/storage
                }
            }
            

            ProductCategory::create($data);
            Toastr::success('Category created successfully.');
            return redirect()->route('categories.index');

        } catch (\Exception $e) {
            \Log::error('Error while storing category: ' . $e->getMessage());
            Toastr::error('Failed to create category.');
            return redirect()->route('categories.index');
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|unique:product_categories,name',
            'slug'      => 'nullable|string|unique:product_categories,slug',
            'status'    => 'required|boolean',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $product = ProductCategory::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'status' => $request->status,
            ]);

            if ($request->hasFile('image')) {
                $product->image = $request->file('image')->store('categories', 'public');
                $product->save();
            }
            Toastr::success('Category created successfully.');
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            \Log::error('Error while storing category: ' . $e->getMessage());
            Toastr::error('Failed to create category.');
            return redirect()->route('categories.index');
        }
    }

    // Show edit form
    public function edit($id)
    {
        $categories = ProductCategory::where('parent_category', 0)->get();
        $row = ProductCategory::findOrFail($id);
        return view('admin.categories.edit', compact('row','categories'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:product_categories,name,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => __('productcategories.form.validation.name.required'),
            'name.unique' => __('productcategories.form.validation.name.unique'),
            'image.image' => __('productcategories.form.validation.image.image'),
            'image.mimes' => __('productcategories.form.validation.image.mimes'),
            'image.max' => __('productcategories.form.validation.image.max'),
        ]);
    
        try {
            $category = ProductCategory::findOrFail($id);

            $parentCategoryId = $request->parent_category ? $request->parent_category : 0;
            $slug = Str::slug($request->name, '-');
            if ($request->hasFile('image')) {
                if ($category->image) {
                    Storage::disk('public')->delete($category->image);
                }
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $imagePath = $request->image->storeAs('categories', $imageName, 'public');
            } else {
                $imagePath = $category->image;
            }
            $category->update([
                'name' => $request->name,
                'parent_category' => $parentCategoryId,
                'slug' => $slug,
                'status' => $request->status,
                'image' => $imagePath, 
            ]);
    
            Toastr::success(__('productcategories.message.update.success'));
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            \Log::error('Error while updating category: ' . $e->getMessage());
            Toastr::error(__('productcategories.message.update.error'));
            return redirect()->route('categories.index');
        }
    }
    

    // Delete category
    public function destroy(Request $request)
    {
        try {
            $category = ProductCategory::findOrFail($request->id);
            $category->delete();
            return back()->with(Toastr::error(__('productcategories.message.destroy.success')));
        } catch (\Exception $e) {
            $error_msg = Toastr::error(__('productcategories.message.destroy.error'));
            return redirect()->route('categories.index')->with($error_msg);
        }
    }
    public function status_update(Request $request)
	{
		$user = ProductCategory::find($request->id)->update(['status' => $request->status]);

		if($request->status == 1)
        {
            return response()->json(['message' => 'Status activated successfully.']);
        }
        else{ 
            return response()->json(['message' => 'Status deactivated successfully.']);
        }  
	}
}

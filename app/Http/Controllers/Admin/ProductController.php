<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product; 
use Illuminate\Http\Request;
use Exception;
use DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Gate;
use Spatie\Permission\Models\Permission;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:product-list', ['only' => ['index','store']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
        $permissions = ['product-list', 'product-create', 'product-edit', 'product-delete'];
        
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $edit = Gate::check('product-edit') ? '<a href="'.route('products.edit', $row->id).'" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i> '.__('default.form.edit-button').'
                                </a>' : '';

                    $delete = Gate::check('product-delete') ? '<button class="custom-delete-btn remove-product" data-id="'.$row->id.'" data-action="'.route('products.destroy').'">
                                        <i class="fe fe-trash"></i> '.__('default.form.delete-button').'
                                    </button>' : '';

                    return $edit.' '.$delete;
                })
                ->addColumn('status', function($row){
                    if ($row->status == 1) {
                        $current_status = 'Checked';
                    }else{
                        $current_status = '';
                    }

                    $status = "

                            <input type='checkbox' id='status_$row->id' id='category-$row->id' class='check' onclick='changeCmsCategoryStatus(event.target, $row->id);' " .$current_status. ">
                            <label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";
                    return $status;
                })
                
                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
                ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
                ->escapeColumns([])
                ->make(true);
        }
        return view('admin.cmspages.products.index');
    }

    public function create()
    {
        return view('admin.cmspages.products.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required|string|unique:products,name',
            'slug'      => 'required|string|unique:products,slug',
            'status'    => 'required|boolean',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    
        $messages = [
            'name.required'    => __('default.form.validation.name.required'),
            'name.unique'      => __('default.form.validation.name.unique'),
            'slug.required'    => __('default.form.validation.slug.required'),
            'slug.unique'      => __('default.form.validation.slug.unique'),
            'status.required'  => __('default.form.validation.status.required'),
            'image.image'      => __('default.form.validation.image.image'),
            'image.mimes'      => __('default.form.validation.image.mimes'),
            'image.max'        => __('default.form.validation.image.max'),
        ];
    
        $this->validate($request, $rules, $messages);
    
        try {
            $data = $request->all();
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                if ($image->isValid()) {
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('products'), $imageName); // ← Store in public/products
                    $data['image'] = $imageName;
                }
            }
    
            Product::create($data);
    
            Toastr::success(__('product.message.store.success'));
            return redirect()->route('products.index');
        } catch (Exception $e) {
            Toastr::error(__('product.message.store.error'));
            return redirect()->route('products.index');
        }
    }
    
    
    

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.cmspages.products.edit', compact('product'));
    }

    // public function update(Request $request, $id)
    // {
    //     $rules = [
    //         'name'      => 'required|string|unique:products,name,' . $id,
    //         'slug'      => 'required|string|unique:products,slug,' . $id,
    //         'status'    => 'required|boolean',
    //         'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ];
    
    //     $messages = [
    //         'name.required'    => __('default.form.validation.name.required'),
    //         'name.unique'      => __('default.form.validation.name.unique'),
    //         'slug.required'    => __('default.form.validation.slug.required'),
    //         'slug.unique'      => __('default.form.validation.slug.unique'),
    //         'status.required'  => __('default.form.validation.status.required'),
    //         'image.image'      => __('default.form.validation.image.image'),
    //         'image.mimes'      => __('default.form.validation.image.mimes'),
    //         'image.max'        => __('default.form.validation.image.max'),
    //     ];
    
    //     $this->validate($request, $rules, $messages);
    
    //     try {
    //         $product = Product::findOrFail($id);
    //         if ($request->hasFile('image')) {
    //             if ($product->image && file_exists(public_path('storage/products/' . $product->image))) {
    //                 unlink(public_path('storage/products/' . $product->image));
    //             }
    
    //             $image = $request->file('image');
    //             $imageName = time() . '.' . $image->getClientOriginalExtension();
    //             $image->storeAs('public/products', $imageName);
    //             $request->merge(['image' => $imageName]);
    //         }
    //         $product->update($request->all());
    //         Toastr::success(__('product.message.update.success'));
    //         return redirect()->route('products.index');
            
    //     } catch (Exception $e) {
    //         Toastr::error(__('product.message.update.error'));
    //         return redirect()->route('products.index');
    //     }
    // }
    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    // Validation rules
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
        'status' => 'required|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    try {
        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && file_exists(public_path('storage/products/' . $product->image))) {
                unlink(public_path('storage/products/' . $product->image));
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName);

            $validated['image'] = $imageName;
        }

        $product->update($validated);

        Toastr::success(__('product.message.update.success'));
        return redirect()->route('products.index');
    } catch (Exception $e) {
        Toastr::error(__('product.message.update.error'));
        return redirect()->route('products.index');
    }
}

    
    public function destroy(Request $request)
    {
        try {
            Product::findOrFail($request->input('id'))->delete();
            Toastr::success(__('product.message.destroy.success'));
        } catch (Exception $e) {
            Toastr::error(__('product.message.destroy.error'));
        }
        return redirect()->route('products.index');
    }

    public function status_update(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->update(['status' => $request->status]);

        $message = $request->status == 1 ? 'Product activated successfully.' : 'Product deactivated successfully.';
        return response()->json(['message' => $message]);
    }
}

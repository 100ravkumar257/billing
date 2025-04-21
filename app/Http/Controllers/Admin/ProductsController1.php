<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Brand;
use App\Models\Shade;
use App\Models\PackagingType;
use Spatie\Permission\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ProductsController1 extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:product-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);

        
        $permissions = ['product-list', 'product-create', 'product-edit', 'product-delete'];
        foreach ($permissions as $perm) {
            if (Permission::where('name', $perm)->doesntExist()) {
                Permission::create(['name' => $perm]);
            }
        }
    }

  
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with(['category', 'brand', 'shade', 'packagingType'])->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = Gate::allows('product-edit') ? '<a href="' . route('products.edit', $row->id) . '" class="custom-edit-btn mr-1"><i class="fe fe-pencil"></i></a>' : '';
                    $delete = Gate::allows('product-delete') ? '<button class="custom-delete-btn remove-product" data-id="' . $row->id . '" data-action="' . route('products.destroy') . '"><i class="fe fe-trash"></i></button>' : '';
                    return $edit . ' ' . $delete;
                })
                ->editColumn('price', function ($row) {
                    return '₹' . number_format($row->price, 2);
                })
                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.products.index');
    }

   
    public function create() 
    {
        $categories = ProductCategory::all();
        $brands = Brand::all();
        $shades = Shade::all();
        $packagingTypes = PackagingType::all();
        return view('admin.products.create', compact('categories', 'brands', 'shades', 'packagingTypes'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'shade_id' => 'required|exists:shades,id',
            'packaging_type_id' => 'required|exists:packaging_types,id',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products,sku',
            'hsn' => 'required',
            'tax' => 'required|numeric',
            'weight' => 'required|numeric',
            'density' => 'required|numeric',
        ]);

        //dd($request->all());

        try {
            Product::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'short_description' => $request->short_description,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'shade_id' => $request->shade_id,
                'packaging_type_id' => $request->packaging_type_id,
                'price' => $request->price,
                'sku' => $request->sku,
                'hsn' => $request->hsn,
                'tax' => $request->tax,
                'weight' => $request->weight,
                'density' => $request->density,
                'status' => $request->status,
            ]);

            Toastr::success(__('product.message.store.success'));
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            Toastr::error(__('product.message.store.error'));
            return redirect()->route('products.index');
        }
    }

    // Show edit form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();
        $brands = Brand::all();
        $shades = Shade::all();
        $packagingTypes = PackagingType::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'shades', 'packagingTypes'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:products,name,' . $id,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'shade_id' => 'required|exists:shades,id',
            'packaging_type_id' => 'required|exists:packaging_types,id',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products,sku,' . $id,
            'hsn' => 'required',
            'tax' => 'required|numeric',
            'weight' => 'required|numeric',
            'density' => 'required|numeric',
        ]);

        try {
            $product = Product::findOrFail($id);
            $product->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'shade_id' => $request->shade_id,
                'packaging_type_id' => $request->packaging_type_id,
                'price' => $request->price,
                'sku' => $request->sku,
                'hsn' => $request->hsn,
                'tax' => $request->tax,
                'weight' => $request->weight,
                'density' => $request->density,
            ]);

            Toastr::success(__('product.message.update.success'));
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            Toastr::error(__('product.message.update.error'));
            return redirect()->route('products.index');
        }
    }

    // Delete product
    public function destroy(Request $request)
    {
        try {
            $product = Product::findOrFail($request->id);
            $product->delete();
            Toastr::success(__('product.message.destroy.success'));
            return back();
        } catch (\Exception $e) {
            Toastr::error(__('product.message.destroy.error'));
            return redirect()->route('products.index');
        }
    }

    // Update product status
    public function status_update(Request $request)
    {
        $product = Product::find($request->id)->update(['status' => $request->status]);

        if ($request->status == 1) {
            return response()->json(['message' => 'Status activated successfully.']);
        } else {
            return response()->json(['message' => 'Status deactivated successfully.']);
        }
    }
}

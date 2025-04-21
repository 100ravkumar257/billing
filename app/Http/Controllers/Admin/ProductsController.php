<?php
namespace App\Http\Controllers\Admin;

use DB;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use App\Models\ProductCategory;
use App\Models\ProductVariant;
use App\Models\Brand;
use Spatie\Permission\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:products-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
        $this->middleware('permission:product-variant', ['only' => ['variant']]);

        $permissions = ['product-list', 'product-create', 'product-edit', 'product-delete', 'product-variant'];
        foreach ($permissions as $perm) {
            if (Permission::where('name', $perm)->doesntExist()) {
                Permission::create(['name' => $perm]);
            }
        }
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->select(
                    'products.*',
                    'product_categories.name as category_name',
                    'brands.name as brand_name'
                )
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $edit = Gate::check('product-edit') ? '<a href="' . route('products.edit', $row->id) . '" class="custom-edit-btn mr-1">
                                <i class="fe fe-pencil"></i> 
                            </a>' : '';

                    $variant = Gate::check('product-variant') ? '<a href="' . route('products.variants', $row->id) . '" class="custom-edit-btn mr-1">
                               <i class="fa fa-circle-o-notch" aria-hidden="true"></i> ' . __('variant ') . '
                            </a>' : '';

                    $delete = Gate::check('product-delete') ? '<button class="custom-delete-btn remove-product" data-id="' . $row->id . '" data-action="' . route('products.destroy') . '">
                                    <i class="fe fe-trash"></i> 
                                </button>' : '';

                    return $variant . ' ' . $edit . ' ' . $delete;
                })

                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $current_status = 'Checked';
                    } else {
                        $current_status = '';
                    }

                    $status = "
                        <input type='checkbox' id='status_$row->id' id='product-$row->id' class='check' onclick='changeProductStatus(event.target, $row->id);' " . $current_status . ">
                        <label for='status_$row->id' class='checktoggle'>checkbox</label>
                ";
                    return $status;
                })
                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
                ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
                ->escapeColumns([])
                ->make(true);
        }

        return view('admin.products.index');
    }

    public function destroyVariant(Product $product, Variant $variant)
    {
        try {
            $variant->delete();

            return response()->json(['success' => true, 'message' => 'Variant deleted successfully!']);
        } catch (\Exception $e) {
            \Log::error("Error deleting variant: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Something went wrong.']);
        }
    }
    
    public function createVariant($productId, Request $request)
    {
        $product = Product::findOrFail($productId);
        $deleteButton = Gate::check('product-delete') ?
            '<button class="custom-delete-btn remove-product" data-id="' . $product->id . '" data-action="' . route('products.destroy') . '">
            <i class="fe fe-trash"></i> ' . __('default.form.delete-button') . '
        </button>' : null;
        $variantId = $request->query('vid');
        $variant = null;
        if ($variantId) {
            $variant = $product->variants()->findOrFail($variantId);
        }
        return view('admin.products.create_variant', compact('product', 'variant', 'deleteButton'));
    }
    public function storeVariant(Request $request, Product $product)
    {
        $validated = $request->validate([
            'sku' => 'required|array',
            'sku.*' => 'required|string|max:255',
            'size' => 'required|array',
            'size.*' => 'required|string',
            'calculated_size' => 'required|array',
            'calculated_size.*' => 'required|numeric',
            'pcs_per_pack' => 'required|array',
            'pcs_per_pack.*' => 'required|numeric',
            'layers_per_pack' => 'required|array',
            'layers_per_pack.*' => 'required|numeric',
            'packing_weight' => 'required|array',
            'packing_weight.*' => 'required|numeric',
            'box_qty' => 'required|array',
            'box_qty.*' => 'required|numeric',
            'price' => 'required|array',
            'price.*' => 'required|numeric',
        ]);
        try {
            foreach ($validated['sku'] as $index => $sku) {
                $product->variants()->create([
                    'sku' => $sku,
                    'size' => $validated['size'][$index],
                    'calculated_size' => $validated['calculated_size'][$index],
                    'pcs_per_pack' => $validated['pcs_per_pack'][$index],
                    'layers_per_pack' => $validated['layers_per_pack'][$index],
                    'packing_weight' => $validated['packing_weight'][$index],
                    'box_qty' => $validated['box_qty'][$index],
                    'price' => (float) $validated['price'][$index],
                    'status' => true,
                ]);
            }
            return redirect()->route('products.variants', $product->id)
                ->with('success', 'Variants added successfully!');
        } catch (\Exception $e) {
            \Log::error("Error adding variants: " . $e->getMessage());
            return redirect()->route('products.variants', $product->id)
                ->with('error', 'Something went wrong.');
        }
    }


    public function updateVariant(Request $request, Product $product, Variant $variant)
    {
        $validated = $request->validate([
            'sku' => 'required|string|max:255',
            'size' => 'required|string',
            'calculated_size' => 'required|numeric',
            'pcs_per_pack' => 'required|numeric',
            'layers_per_pack' => 'required|numeric',
            'packing_weight' => 'required|numeric',
            'box_qty' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        try {
            $variant->update([
                'sku' => $validated['sku'],
                'size' => $validated['size'],
                'calculated_size' => $validated['calculated_size'],
                'pcs_per_pack' => $validated['pcs_per_pack'],
                'layers_per_pack' => $validated['layers_per_pack'],
                'packing_weight' => $validated['packing_weight'],
                'box_qty' => $validated['box_qty'],
                'price' => $validated['price'],
            ]);

            return redirect()->route('products.variants', [$product->id])
                ->with('success', 'Variant updated successfully.');
        } catch (\Exception $e) {
            \Log::error("Error updating variant: " . $e->getMessage());
            return redirect()->route('products.variants', [$product->id])
                ->with('error', 'Something went wrong.');
        }
    }
    public function variantdelete(Product $product, ProductVariant $variant)
    {
        $variant->delete();
        return redirect()->route('products.variant.create_variant', [$product->id])
            ->with('success', 'Variant deleted successfully!');
    }

    public function create()
    {
        $categories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store1(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'category_id' => 'required|exists:product_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'short_desc' => 'required|string',
            'density' => 'required|numeric',
            'status' => 'required|boolean',
            'images.*' => 'image|max:2048',
        ]);

        try {
            $product = Product::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'short_desc' => $request->short_desc,
                'density' => $request->density,
                'status' => $request->status,
            ]);

            if ($request->hasFile('image')) {
                $product->image = $request->file('image')->store('products', 'public');
                $product->save();
            }
            Toastr::success(__('product.message.store.success'));
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            Log::error('Product Store Error: ' . $e->getMessage());
            Toastr::error(__('product.message.store.error'));
            return redirect()->route('products.index');
        }
    }
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'slug' => 'required',
        'category_id' => 'required|exists:product_categories,id',
        'brand_id' => 'required|exists:brands,id',
        'short_desc' => 'required|string',
        'density' => 'required|numeric',
        'status' => 'required|boolean',
        'image' => 'nullable|image|max:2048',
    ]);

    try {
        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'short_desc' => $request->short_desc,
            'density' => $request->density,
            'status' => $request->status,
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName); // stored in storage/app/public/products
            $product->image = 'storage/products/' . $imageName; // public path
            $product->save();
        }

        Toastr::success(__('product.message.store.success'));
        return redirect()->route('products.index');
    } catch (\Exception $e) {
        Log::error('Product Store Error: ' . $e->getMessage());
        Toastr::error(__('product.message.store.error'));
        return redirect()->route('products.index');
    }
}




    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();
        $brands = Brand::all();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:products,name,' . $product->id,
            'slug' => 'required|unique:products,slug,' . $product->id,
            'category_id' => 'required|exists:product_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'short_desc' => 'required|string',
            'density' => 'required|numeric',
            'status' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        try {
            $product->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'short_desc' => $request->short_desc,
                'density' => $request->density,
                'status' => $request->status,
            ]);

            if ($request->hasFile('image')) {
                if ($product->image && Storage::exists('public/' . $product->image)) {
                    Storage::delete('public/' . $product->image);
                }
                $product->image = $request->file('image')->store('products', 'public');
                $product->save();
            }

            Toastr::success(__('product.message.update.success'));
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            Log::error('Product Update Error: ' . $e->getMessage());
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
<?php

namespace App\Http\Controllers\Admin;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariant;
use App\Models\Brand;
use Spatie\Permission\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class ProductVariantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:products-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
        $this->middleware('permission:product-variant', ['only' => ['variant']]);

        $permissions = ['product-list', 'product-create', 'product-edit', 'product-delete','product-variant'];
        foreach ($permissions as $perm) {
            if (Permission::where('name', $perm)->doesntExist()) {
                Permission::create(['name' => $perm]);
            }
        }
    }
 
    public function createVariant($productId)
    {
        $product = Product::findOrFail($productId);

        $variant = null;
        if (request()->has('vid')) {

            $vid = request('vid');

            $variant = DB::table('product_variants') 
                         ->where('product_id', $productId)
                         ->where('id', $vid)
                         ->first(); 
    
                        //  dd($variant);
        }
    
        return view('admin.products.create_variant', compact('product', 'variant'));
    }
    
    
    
    public function storeVariant(Request $request, Product $product)
    {
        $validated = $request->validate([
            'sku' => 'required|array',
            'sku.*' => 'required|string|max:255', 
            'size' => 'required|array',
            'size.*' => 'required|numeric',
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
                    // 'box_weight' => $validated['box_weight'][$index],
                    'box_qty' => $validated['box_qty'][$index],
                    'price' => $validated['price'][$index],
                    'status' => true, 
                ]);
            }
            return redirect()->route('products.variant.store') ->with('success', 'Variants added successfully!');
        } catch (\Exception $e) {
            \Log::error("Error creating variants: " . $e->getMessage());
            return redirect()->back()->with('error', 'There was an error creating the variants. Please try again.');
        }
    }
    
    public function edit(Product $product, ProductVariant $variant)
        {
    
            
            return view('admin.products.edit', compact('product', 'variant'));
        }
    
    
    public function update(Request $request, Product $product, ProductVariant $variant)
    {
    
        $validatedData = $request->validate([
            'sku' => 'required|string|max:255',
            'size' => 'required|numeric',
            'calculated_size' => 'required|numeric',
            'pcs_per_pack' => 'required|numeric',
            'layers_per_pack' => 'required|numeric',
            'packing_weight' => 'required|numeric',
            // 'box_weight' => 'required|numeric',
            'box_qty' => 'required|numeric',
            'price' => 'required|numeric'
        ]);
        dd( $validatedData );
        if ($variant->id !== $request->input('id')) {
            return redirect()->route('products.variant.edit', [$product->id, $variant->id])
                             ->withErrors(['error' => 'The variant ID does not match.']);
        }
    
        $variant->update($validatedData);
    
        return redirect()->route('products.variant.edit', [$product->id, $variant->id])
                         ->with('success', 'Variant updated successfully!');
    }
    
    public function destroy(Product $product, ProductVariant $variant)
    {
        $variant->delete();
        return redirect()->route('products.variant.edit', $product->id)->with('success', 'Variant deleted successfully!');
    }

}

<?php

namespace App\Http\Controllers\Frontend\Retailer; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User; 
use App\Models\Brand; 
use DB;
use App\Models\Frontend\Retailer\ProductCategory;
use App\Models\Frontend\Retailer\ProductVariant;
use App\Models\Frontend\Retailer\Product;
use Illuminate\Support\Facades\Crypt;


class ShopController1 extends Controller
{
    
    public function __construct()
    {
        if (!session()->has('retailer_id')) {
            return redirect()->route('retailer');
        }
    } 
    
    // public function index()
    // {
  
    //     $retailerId = session('retailer_id');

    //     $retailer = User::where('id', $retailerId)
    //     ->where('status', 1)
    //     ->select('name') 

    //     ->first();

    //     $categories = ProductCategory::where('status', 1)
    //     ->where('parent_category', 0)
    //     ->where('status', 1)
    //     ->whereNull('deleted_at')
    //     ->get();

    //     $products = Product::with(['variants' => function ($query) {
    //         $query->select('product_id', 'size'); 
    //     }])
    //     ->where('status', 1)
    //     ->whereNull('deleted_at')
    //     ->get();

    //     return view('frontend.retailer.home',compact('retailerId','retailer','categories', 'products'));  
        
    // }
    public function index()
    {
        $retailerId = session('retailer_id');
        $retailer = User::where('id', $retailerId)
                        ->where('status', 1)
                        ->select('name')
                        ->first();
    
        $categories = ProductCategory::where('status', 1)
                                     ->where('parent_category', 0)
                                     ->whereNull('deleted_at')
                                     ->get();
        $category = $categories[0];
        // dd($category->id);
        $products = Product::with(['variants' => function ($query) {
            $query->select('product_id', 'size');
            
        }])
        ->where('category_id', $category->id)
        ->where('status', 1)
        ->whereNull('deleted_at')
        ->get();
    
        $activeCategorySlug = $categories->first()->slug; 
    
        return view('frontend.retailer.home', compact('retailerId', 'retailer', 'categories', 'products', 'activeCategorySlug'));
    }
    
    
    public function getProductVariants($id)
    {
        $product = Product::with('variants', 'category')
            ->where('status', 1)
            ->whereNull('deleted_at')
            ->find($id);
    
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        return response()->json([
            'name' => $product->name,
            'product_id' => $product->id,
            'category_id' => $product->category->id, 
            'category_name' => $product->category->name,  
            'variants' => $product->variants->map(function ($variant) {
                return [
                    'variant_id' => $variant->id,
                    'size' => $variant->size,
                    'sku' => $variant->sku,
                    'per_pack' => $variant->pcs_per_pack,
                    'layer_pack' => $variant->layers_per_pack,
                    'box_qty' => $variant->box_qty,
                    'calculated' => $variant->calculated_size,
                ];
            }),
        ]);
    }
    

     // dd($products);

    // public function getCategoryProducts($slug) { 
    //     $category = ProductCategory::where('slug', $slug)
    //                     ->whereNull('deleted_at') 
    //                     ->first();
    
    //     if (!$category) {
    //         return redirect()->route('retailer.shop');
    //     }
    
    //     $category_name = ucfirst($category->name);
    //     // print_r($_COOKIE['brandId']);exit;
    //     $brand_id = $_COOKIE['brandId'];
    //     // dd($brand_id); 

    //     $products = Product::with(['variants' => function ($query) {
    //         $query->select('product_id', 'size'); 
    //     }])
    //     ->where('category_id', $category->id)
    //     ->where('status', 1);
    
    //     if ($brand_id) {
    //         $products->where('brand_id', $brand_id);
    //     }
    
    //     $products = $products->get();
    
    //     return view('frontend.retailer.category-product', compact('category_name', 'products'));
    // }
    
    public function showHeader() {
        $categories = ProductCategory::all();  
        
        return view('frontend.retailer.common.header', compact('categories'));  
    }
    
    public function getCategoryProducts($slug) { 
        $category = ProductCategory::where('slug', $slug)
                        ->whereNull('deleted_at') 
                        ->first();
    
        if (!$category) {
            return redirect()->route('retailer.shop');
        }
    
        $category_name = ucfirst($category->name);
        $brand_id = $_COOKIE['brandId'];
        $brandids = Brand::select(DB::raw('GROUP_CONCAT(id) as ids'))
            ->where('parent_id', $brand_id)
            ->pluck('ids');
        
        $products = Product::with(['variants' => function ($query) {
                $query->select('product_id', 'size'); 
            }])
            ->where('category_id', $category->id)
            ->where('status', 1);
        if ($brandids) {
            $brandIdsArray = explode(',', $brandids[0]); 
            $brandIdsArray[] = $brand_id; 
            $products->whereIn('brand_id', $brandIdsArray);
        }
        
        
    
        $products = $products->get();
        
        return view('frontend.retailer.category-product', compact('category_name', 'products'));
    }
    

    
    public function search(Request $request) {

        $query = $request->get('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->whereNull('deleted_at') 
            ->select('id', 'name', 'slug')
            ->get();

        return response()->json($products);
    }

    public function show($slug)
    {
    
        $products = Product::with(['variants' => function ($query) {
            $query->select('product_id', 'size'); 
        }])
        ->where('slug', $slug)
        ->where('status', 1)
        ->whereNull('deleted_at')
        ->first();

       // dd($products);

        return view('frontend.retailer.product-details', compact('products'));
    }


    

}


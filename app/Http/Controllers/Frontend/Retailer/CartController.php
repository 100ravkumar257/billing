<?php

namespace App\Http\Controllers\Frontend\Retailer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Frontend\Retailer\ProductVariant;
use App\Models\Frontend\Retailer\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Mail\OrderSuccessMail;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Request;

class CartController extends Controller 
{
    public function __construct()
    {
        if (!session()->has('retailer_id')) {
            return redirect()->route('retailer');
        }
    }

    public function addToCart(Request $request)
    {
        $cart = Session::get('cart', []);

        $key = $request->product_id . '-' . $request->variant_id;

        if ($request->quantity > 0) {
            $cart[$key] = [
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
                'quantity'   => $request->quantity
            ];
        } else {
            unset($cart[$key]);
        }

        Session::put('cart', $cart);

        return response()->json(['message' => 'Cart added successfully', 'cart' => $cart]);
    }

    public function updateCart(Request $request)
    {
        $cart = Session::get('cart', []);
    
        if ($request->has('cart_key')) {  // ✅ Use instance method
            $cartKey = $request->cart_key;
            if (isset($cart[$cartKey])) {
                $cart[$cartKey]['quantity'] = $request->quantity;
                Session::put('cart', $cart);
            }
            return response()->json(['success' => true, 'cart' => $cart]);
        }
    
        if ($request->has('product_id') && $request->has('variant_id')) {  // ✅ Correct usage
            $productId = $request->product_id;
            $variantId = $request->variant_id;
            $quantity = $request->quantity;
    
            $cartKey = "$productId-$variantId";
    
            if (isset($cart[$cartKey])) {
                $cart[$cartKey]['quantity'] = $quantity;
            } else {
                $cart[$cartKey] = [
                    'product_id' => $productId,
                    'variant_id' => $variantId,
                    'quantity'   => $quantity,
                ];
            }
    
            Session::put('cart', $cart);
    
            return response()->json([
                'message'     => 'Cart updated successfully',
                'cart'        => $cart,
                'total_count' => count($cart),
            ]);
        }
    
        return response()->json(['success' => false, 'message' => 'Invalid request']);
    }
    
    public function getCart()
    {
        $cart = Session::get('cart', []);
        $total_count = count($cart);
    
        return response()->json([
            'cart' => $cart,
            'total_count' => $total_count
        ]);
    }

public function removeCartItem(Request $request)
{
    $cart = Session::get('cart', []);

    $cartKey = $request->cart_key;
    if (isset($cart[$cartKey])) {
        unset($cart[$cartKey]);
        Session::put('cart', $cart);
    }
    return response()->json(['success' => true, 'cart' => $cart]);
}

    // public function cartDetails()
    // {


    //     $cart = Session::get('cart', []);
    
    //     $productIds = array_column($cart, 'product_id');
    //     $variantIds = array_column($cart, 'variant_id');
    
    //     // $products = Product::whereIn('id', $productIds)->get()->keyBy('id');
    //     $products = Product::whereIn('id', $productIds)
    //     ->with('category') 
    //     ->get()
    //     ->keyBy('id');
    //     $variants = ProductVariant::whereIn('id', $variantIds)->get()->keyBy('id');
    
    //     $cartDetails = [];
    //     foreach ($cart as $cartKey => $item) {
    //         $product = $products[$item['product_id']] ?? null;
    //         $variant = $variants[$item['variant_id']] ?? null;
    //         // dd($product);
    //         if ($product && $variant) {
    //             $cartDetails[$cartKey] = [
    //                 'cart_key'     => $cartKey,
    //                 'product_id'   => $product->id,
    //                 'product_name' => $product->name,
    //                 'category_id'  => $product->category_id,  
    //                 'category_name' => $product->category->name, 
    //                 'variant_id'   => $variant->id,
    //                 'variant_name' => $variant->name, 
    //                 'size'         => $variant->size, 
    //                 'packing_weight' => $variant->packing_weight, 
    //                 'calculated_size' => $variant->calculated_size,
    //                 'pcs_per_pack' => $variant->pcs_per_pack,
    //                 'layers_per_pack' => $variant->layers_per_pack,
    //                 'total_packing_weight' => $variant->packing_weight * $item['quantity'],
    //                 'quantity'     => $item['quantity'],
    //             ];
    //         }
    //     }
    //     dd($cartDetails);
    //     return view('frontend.retailer.cart-details', compact('cartDetails'));
    // }
    public function cartDetails()
    {
        $cart = Session::get('cart', []);
    
        $productIds = array_column($cart, 'product_id');
        $variantIds = array_column($cart, 'variant_id');
    
        $products = Product::whereIn('id', $productIds)
            ->with('category')
            ->get()
            ->keyBy('id');
        
        $variants = ProductVariant::whereIn('id', $variantIds)
            ->get()
            ->keyBy('id');
    
        $cartDetails = [];
        $totalPackingWeight = 0; 
    
        foreach ($cart as $cartKey => $item) {
            $product = $products[$item['product_id']] ?? null;
            $variant = $variants[$item['variant_id']] ?? null;
    
            if ($product && $variant) {
                $itemTotalPackingWeight = $variant->packing_weight * $item['quantity']; 
                $totalPackingWeight += $itemTotalPackingWeight; 
    
                $cartDetails[$cartKey] = [
                    'cart_key'     => $cartKey,
                    'product_id'   => $product->id,
                    'product_name' => $product->name,
                    'category_id'  => $product->category_id,  
                    'category_name' => $product->category->name, 
                    'variant_id'   => $variant->id,
                    'variant_name' => $variant->name, 
                    'size'         => $variant->size, 
                    'packing_weight' => $variant->packing_weight, 
                    'calculated_size' => $variant->calculated_size,
                    'pcs_per_pack' => $variant->pcs_per_pack,
                    'layers_per_pack' => $variant->layers_per_pack,
    
                    'quantity'     => $item['quantity'],
                    'total_packing_weight' => $itemTotalPackingWeight, 
                ];
            }
        }
        session(['total_packing_weight' => $totalPackingWeight]);
        // dd($cartDetails);
        return view('frontend.retailer.cart-details', compact('cartDetails', 'totalPackingWeight'));
    }
    

    public function saveCartItem(Request $request) {

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('retailer.shop');
        } 
        $ipAddress = $request->ip();

        $order_id = DB::table('order')->insertGetId([
            'retailer_id' => session('retailer_id'), 
            'order_date'  => now()->format('Y-m-d'), 
            'status'      => 1, 
            'ip'          => $ipAddress, 
            'indate'      => now(), 
            'created_by'  =>  session('salesperson_id'),
        ]);

        $orderCode = 'ORD' . (1000 + $order_id);

        DB::table('order')->where('id', $order_id)->update(['order_code' => $orderCode ]);

        foreach ($cart as $cartKey => $item) {
            DB::table('order_item')->insert([
                'order_id'   => $order_id,
                'product_id' => $item['product_id'],
                'variant_id' => $item['variant_id'],
                'quantity'   => $item['quantity'],
                'indate'     => now(),
            ]);
        }

        DB::table('order_approver')->insert([
            'order_id'    => $order_id,
            'retailer_id' => session('retailer_id'),
            'status'      => 1, 
            'indate'      => now(), 
        ]);

        Session::forget('cart');
        return redirect()->route('retailer.order.success', ['order_id' => $order_id]);

    }

    // public function success() {

    //     return view('frontend.retailer.order-success');
    // }


// public function saveCartItem(Request $request) {
//     $cart = Session::get('cart', []);

//     if (empty($cart)) {
//         return redirect()->route('retailer.shop');
//     } 

//     $ipAddress = $request->ip();

//     $order_id = DB::table('order')->insertGetId([
//         'retailer_id' => session('retailer_id'), 
//         'order_date'  => now()->format('Y-m-d'), 
//         'status'      => 1, 
//         'ip'          => $ipAddress, 
//         'indate'      => now(), 
//         'created_by'  =>  session('salesperson_id'),
//     ]);

//     $orderCode = 'ORD' . (1000 + $order_id);

//     DB::table('order')->where('id', $order_id)->update(['order_code' => $orderCode]);

//     foreach ($cart as $cartKey => $item) {
//         DB::table('order_item')->insert([
//             'order_id'   => $order_id,
//             'product_id' => $item['product_id'],
//             'variant_id' => $item['variant_id'],
//             'quantity'   => $item['quantity'],
//             'indate'     => now(),
//         ]);
//     }

//     DB::table('order_approver')->insert([
//         'order_id'    => $order_id,
//         'retailer_id' => session('retailer_id'),
//         'status'      => 1, 
//         'indate'      => now(), 
//     ]);

    
//     $userEmail = session('user_email'); 
//     Mail::to($userEmail)->send(new OrderSuccessMail($order_id, $userEmail));
//     Session::forget('cart');

//     return redirect()->route('retailer.order.success', ['order_id' => $order_id]);
// }

    public function success(Request $request) {
        $order_id = $request->get('order_id');
        // dd($order_id);
        return view('frontend.retailer.order-success', compact('order_id'));
    }
    

    // public function retailer_order_approve_frm($id){

    //     $salesperson_id = session('salesperson_id');  
    //     $retailer_id = session('retailer_id');
       
    
    //     $order = DB::table('order')
    //     ->where('id', $id)
    //     ->select('id', 'retailer_id', 'order_code', 'order_date')   
    //     ->first();
      

    //     $retailer = User::where('id', $order->retailer_id )
    //     ->where('status', 1)
    //     ->select('id','name','email','mobile')   
    //     ->first();

    //     // dd($retailer );

    //     $items = DB::table('order')
    //     ->join('order_item', 'order.id', '=', 'order_item.order_id')
    //     ->join('products', 'order_item.product_id', '=', 'products.id')
    //     ->join('product_variants', 'order_item.variant_id', '=', 'product_variants.id')
    //     ->select('order.id as order_id', 'order.order_code','products.name','product_variants.size',
    //             'product_variants.sku','product_variants.calculated_size' ,'order_item.*')
    //     ->where('order.id', $id) 
    //     ->get();

    //     //dd($items);

    //     return view('frontend.retailer.order-approval-form',compact('order','items','retailer')); 
    // }

    public function retailer_order_approve_frm($id)
    {
        $salesperson_id = session('salesperson_id');  
        $retailer_id = session('retailer_id');
    
  
        $order = DB::table('order')
            ->where('id', $id)
            ->select('id', 'retailer_id', 'order_code', 'order_date')
            ->first();
    
       
        if (!$order) {
            return redirect()->route('retailer.shop')->with('error', 'Order not found');
        }
    
      
        $retailer = User::where('id', $order->retailer_id)
            ->where('status', 1)
            ->select('id', 'name', 'email', 'mobile')
            ->first();
    
       
        $items = DB::table('order')
            ->join('order_item', 'order.id', '=', 'order_item.order_id')
            ->join('products', 'order_item.product_id', '=', 'products.id')
            ->join('product_variants', 'order_item.variant_id', '=', 'product_variants.id')
            ->join('product_categories', 'products.category_id', '=', 'product_categories.id') 
            ->select('order.id as order_id', 'order.order_code', 'products.name', 'product_variants.size',
                     'product_variants.sku', 'product_variants.calculated_size', 'order_item.*', 
                     'products.category_id', 'product_categories.name as category_name',
                     'product_variants.pcs_per_pack', 'product_variants.layers_per_pack')  
            ->where('order.id', $id)
            ->get();
          
        //    dd($items);
     
        return view('frontend.retailer.order-approval-form', compact('order', 'items', 'retailer'));
    }

    public function approve_order($encryptedOrderId, $encryptedRetailerId){

        $orderId = Crypt::decryptString($encryptedOrderId);
        $retailerId = Crypt::decryptString($encryptedRetailerId);

        $approve = DB::table('order_approver')
        ->where('order_id', $orderId)
        ->where('retailer_id', $retailerId)
        ->select('*')  
        ->first();

        $order = DB::table('order')
        ->where('id', $orderId)
        ->select('order_code')   
        ->first();

        $order_code = $order->order_code;

        if ($approve->mail_action !=1) {
            
            DB::table('order')->where('id', $orderId)->update(['retailer_approved' => 1 ]);

            DB::table('order_approver')
            ->where('order_id', $orderId)
            ->where('retailer_id', $retailerId)
            ->update(['retailer_approval_date' => now(), 'mail_action' => 1 ]);

            $message = "Order No [".$order_code."] is  approved.";
        }else{

            $message = "This Order No [".$order_code."] link is expired.";
        }

        return view('frontend.retailer.approve-order',compact('message'));
    }

    public function reject_order($encryptedOrderId, $encryptedRetailerId){

        $orderId = Crypt::decryptString($encryptedOrderId);
        $retailerId = Crypt::decryptString($encryptedRetailerId);

        $approve = DB::table('order_approver')
        ->where('order_id', $orderId)
        ->where('retailer_id', $retailerId)
        ->select('*')  
        ->first();

        $order = DB::table('order')
        ->where('id', $orderId)
        ->select('order_code')   
        ->first();

        $order_code = $order->order_code;

        if ($approve->mail_action !=1 ) {
            
            DB::table('order')->where('id', $orderId)->update(['retailer_approved' => 2 ]);

            DB::table('order_approver')
            ->where('order_id', $orderId)
            ->where('retailer_id', $retailerId)
            ->update(['retailer_approval_date' => now(), 'mail_action' => 1 ]);

            $message = "Order No  [".$order_code."]  is  rejected.";

        }else{

            $message = "This Order No [".$order_code."] link is expired.";
        }

        return view('frontend.retailer.approve-order',compact('message'));
 
    }

    
}

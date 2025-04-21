<?php

namespace App\Http\Controllers\Frontend\Retailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\User; 

class OrderController extends Controller
{
   public function pending_order(){

    $salesperson_id = session('salesperson_id');  
    $retailer_id = session('retailer_id');

    $orders = DB::table('order')
    ->join('order_approver', 'order.id', '=', 'order_approver.order_id')
    ->join('users', 'users.id', '=', 'order_approver.retailer_id')
    ->select('order.id as order_id', 'order.order_code','order.order_date','order_approver.retailer_approval_date as rej_date','users.name as rej_user','users.email as rej_email','users.mobile as rej_mobile')
    ->where('order.created_by', $salesperson_id)
    ->where('order.retailer_approved', 2)
    ->get();

    return view('frontend.retailer.pending-order', compact('orders'));

   }

   public function pending_order_details($encryptedOrderId){

        $orderId = Crypt::decryptString($encryptedOrderId);
        $salesperson_id = session('salesperson_id');

        $order = DB::table('order')
        ->join('order_approver', 'order.id', '=', 'order_approver.order_id')
        ->join('users', 'users.id', '=', 'order_approver.retailer_id')
        ->select('order.id as order_id', 'order.order_code','order.order_date','order_approver.retailer_approval_date as rej_date','users.name as rej_user','users.email as rej_email','users.mobile as rej_mobile')
        ->where('order.created_by', $salesperson_id)
        ->where('order.retailer_approved', 2)
        ->where('order.id', $orderId)
        ->first();

        $items = DB::table('order')
        ->join('order_item', 'order.id', '=', 'order_item.order_id')
        ->join('products', 'order_item.product_id', '=', 'products.id')
        ->join('product_variants', 'order_item.variant_id', '=', 'product_variants.id')
        ->select('order.id as order_id', 'order.order_code','products.name','product_variants.size',
                'product_variants.sku','product_variants.calculated_size' ,'order_item.*')
        ->where('order.created_by', $salesperson_id)
        ->where('order.retailer_approved', 2)
        ->where('order.id', $orderId)
        ->get(); 

        return view('frontend.retailer.pending-order-details', compact('order','items'));  

   }
}

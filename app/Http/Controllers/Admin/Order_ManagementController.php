<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order_Management;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class Order_ManagementController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:Order_Management-list', ['only' => ['index','store']]);
        $this->middleware('permission:Order_Management-create', ['only' => ['create','store']]);
        $this->middleware('permission:Order_Management-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Order_Management-delete', ['only' => ['destroy']]);
        $this->middleware('permission:Order_Management-details', ['only' => ['index','store']]);
        $permissions = ['Order_Management-list', 'Order_Management-create', 'Order_Management-edit', 'Order_Management-delete','Order_Management-details'];
        
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }

public function index(Request $request)
{
    if ($request->ajax()) {
        try {
            $data = Order_Management::join('users', 'order.retailer_id', '=', 'users.id')
            ->select('order.*', 'users.name as retailer_name')
            ->get();        

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $action = '';
                
                    
                    if (Gate::check('Order_Management-details')) {
                        $action .= '<a href="' . route('Order_Management.details', $row->id) . '" class="custom-edit-btn mr-1">
                                        <i class="fe fe-eye"></i>  
                                    </a>';
                    }
                    
                
                  
                    // if (Gate::check('Order_Management-edit')) {
                    //     $action .= '<a href="' . route('Order_Management.edit', $row->id) . '" class="custom-edit-btn mr-1">
                    //                     <i class="fe fe-pencil"></i>   
                    //                 </a>';
                    // }
                
                    
                    // if (Gate::check('Order_Management-delete')) {
                    //     $action .= '<button class="custom-delete-btn remove-Order_Management" data-id="' . $row->id . '" data-action="' . route('categories.destroy') . '">
                    //                     <i class="fe fe-trash"></i>  
                    //                 </button>';
                    // }
                
                    return $action;
                })
                
                ->addColumn('status', function($row) {
                    if ($row->status == 1) {
                        $current_status = 'Checked';
                    } else {
                        $current_status = '';
                    }

                    $status = "
                            <input type='checkbox' id='status_$row->id' class='check' onclick='changeCmsCategoryStatus(event.target, $row->id);' $current_status>
                            <label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";
                    return $status;
                })
                ->editColumn('created_at', function($row) {
                    return date("jS M Y", strtotime($row->created_at));
                })
                ->editColumn('updated_at', function($row) {
                    return date("jS M Y", strtotime($row->updated_at));
                })
                ->escapeColumns([])
                ->make(true);
        } catch (\Exception $e) {
            Log::error('Error fetching order management data: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
    return view('admin.order_management.index');
}

public function showDetails($orderId)
{
    $order = Order_Management::findOrFail($orderId);
    $order->order_date = \Carbon\Carbon::parse($order->order_date);
    $orderDetails = OrderDetails::with('product', 'variant')
                                ->where('order_id', $orderId)
                                ->get();
    foreach ($orderDetails as $detail) {
        $detail->indate = \Carbon\Carbon::parse($detail->indate);
        $detail->confirm_date = \Carbon\Carbon::parse($detail->confirm_date);
        $detail->product_name = $detail->product ? $detail->product->name : 'Product Not Found';
        $detail->variant_name = $detail->variant ? $detail->variant->name : 'Variant Not Found';
    }
    return view('admin.order_management.details', compact('order', 'orderDetails'));
}





}

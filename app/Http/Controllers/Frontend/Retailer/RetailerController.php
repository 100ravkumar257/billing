<?php
namespace App\Http\Controllers\Frontend\Retailer;

use App\Models\User;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class RetailerController extends Controller {
    
    
    public function index() {
        if (session()->has('retailer_id')) {
            return redirect()->route('retailer.shop');
        }
        
        $retailers = User::where('parent_id', session('salesperson_id'))
        ->where('status', 1)
        ->select('id', 'name')
        ->get(); 
        
        $brands = Brand::whereIn('id', [10, 12])->get(); 

        
        return view('frontend.retailer.select-retailer1', compact('retailers', 'brands'));
    }
    public function get_retailer(Request $request) {
        $request->validate([
            'retailer' => 'required',
        ]);
        
        $retailerId = $request->input('retailer');
        
        session(['retailer_id' => $retailerId]);
        \Log::debug('Retailer ID Set: ' . session('retailer_id')); 
        
        return redirect()->route('retailer.verify');
    }
    
    
    
    public function show_verification_page() {
        $retailer_id = session('retailer_id');
        // dd($retailer_id);  
        
        return view('frontend.retailer.verify-mobile');
    }
    
    
    
    // public function verify_mobile(Request $request) {
    //     $request->validate([
    //         'mobile_number' => 'required|numeric',
    //     ]);
        
    //     $mobileNumber = $request->input('mobile_number');
    //     $retailer = User::find(session('retailer_id'));
        
    //     if ($retailer && $retailer->mobile_number === $mobileNumber) {
    //         return redirect()->route('retailer.shop');
    //     } else {
    //         return redirect()->route('retailer.register')->with('error', 'Mobile number does not match. Please register.');
    //     }
    // }

    // public function checkMobileNumber(Request $request)
    // {
    //     $request->validate([
    //         'mobile_number' => 'required|digits:10'
    //     ]);

    //     // Check if the mobile number exists in the database
    //     $retailer = User::where('mobile', $request->mobile_number)->first();

    //     if ($retailer) {
    //         // Set retailer_id in session
    //         session(['retailer_id' => $retailer->id]);

    //         \Log::debug('Retailer ID Set: ' . session('retailer_id'));

    //         // Redirect to retailer-shop page
    //         return response()->json([
    //             'exists' => true,
    //             'redirect' => true,  // Flag to indicate redirection
    //             'message' => 'Retailer found. Redirecting to shop page.',
    //         ]);
    //     } else {
    //         // Return response if retailer does not exist
    //         return response()->json([
    //             'exists' => false,
    //             'message' => 'Mobile number not found.',
    //         ]);
    //     }
    // }
    public function checkMobileNumber(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10'
        ]);
    
        $retailer = User::where('mobile', $request->mobile)->first();
        // $retailer = User::where('mobile', $request->mobile)
        //             ->where('role_id', 11) 
        //             ->first();
    
        if ($retailer) {
            session([
                'retailer_id' => $retailer->id,
                'retailer_name' => $retailer->name 
            ]);
    
            \Log::debug('Retailer ID Set: ' . session('retailer_id'));
            \Log::debug('Retailer Name Set: ' . session('retailer_name'));
    
            return response()->json([
                'exists' => true,
                'redirect' => true,  
                'message' => 'Retailer found. Redirecting to shop page.',
            ]);
        } else {
            return response()->json([
                'exists' => false,
                'message' => 'Mobile number not found.',
            ]);
        }
    }
    
    
    
    public function showRegistrationForm() {
        return view('frontend.retailer.register');
    }
    
    
//     public function createRetailer(Request $request)
// {
//     try {
//         $validationRules = [
//             'name' => 'required|string|max:255',
//             'mobile' => 'required|digits:10|unique:users,mobile',
//             'password' => 'required',
//         ];

//         if ($request->id_type !== 'pan') {
//             $validationRules['gstin'] = 'required|string|max:255';
//         }
        
//         if ($request->id_type === 'pan') {
//             $validationRules['pan_no'] = 'required|string|max:255';
//         }

//         $request->validate($validationRules);

//         Log::debug('Request Data:', $request->all());

//         $user = new User();
//         $user->name = $request->name;
//         $user->mobile = $request->mobile;
//         $user->gstin = $request->gstin;
//         $user->pan_no = $request->pan_no;
//         $user->password = $request->password;
//         $user->save();

//         $user->roles()->attach(11);

//         session(['retailer_id' => $user->id]);
//         Log::debug('Retailer ID Set: ' . session('retailer_id'));

//         return response()->json([
//             'success' => true,
//             'message' => 'Retailer created successfully!',
//             'redirect' => true,
//         ]);
//     } catch (\Exception $e) {
//         Log::error('Error creating retailer: ' . $e->getMessage());
//         return response()->json([
//             'success' => false,
//             'message' =>  $e->getMessage(),
//         ], 500);
//     }
// }
public function createRetailer(Request $request)
{
    try {
        $validationRules = [
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10|unique:users,mobile',
            'password' => 'required',
        ];

        if ($request->id_type !== 'pan') {
            $validationRules['gstin'] = 'required|string|max:255';
        }
        
        if ($request->id_type === 'pan') {
            $validationRules['pan_no'] = 'required|string|max:255';
        }

        $request->validate($validationRules);

        Log::debug('Request Data:', $request->all());

        $user = new User();
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->gstin = $request->gstin;
        $user->pan_no = $request->pan_no;
        $user->password = $request->password;
        $user->save();

        $user->roles()->attach(11);

        
        session(['retailer_id' => $user->id, 'retailer_name' => $user->name]);
        
        Log::debug('Retailer ID Set: ' . session('retailer_id'));
        Log::debug('Retailer Name Set: ' . session('retailer_name'));

        return response()->json([
            'success' => true,
            'message' => 'Retailer created successfully!',
            'redirect' => true,
        ]);
    } catch (\Exception $e) {
        Log::error('Error creating retailer: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' =>  $e->getMessage(),
        ], 500);
    }
}


    
    public function showShopPage() {
        return view('frontend.retailer.shop');
    }
    
    
    public function handle_verification(Request $request) {
        
        return redirect()->route('retailer.shop');
    }
}

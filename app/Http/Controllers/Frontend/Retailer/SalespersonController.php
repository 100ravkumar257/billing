<?php

namespace App\Http\Controllers\Frontend\Retailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Frontend\Retailer\Salesperson;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;


class SalespersonController extends Controller {

    public function __construct() {
        //$this->middleware('auth.salesperson');
    }  

    public function showLogin() {
        
        if (Auth::guard('salesperson')->check()) {
            return redirect()->route('retailer.shop');
        }   
        return view('frontend.retailer.login'); 
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'id' => 'required',
    ]);

    $credentials = $request->only('email', 'id');
    $user = DB::table('users') 
        ->where('email', $credentials['email'])
        ->where('id', $credentials['id'])
        ->first();

    if ($user) {
        $hasSalesPersonRole = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_has_roles.model_id', $user->id)
            ->where('roles.id', 8)  
            ->exists();

        if ($hasSalesPersonRole) {

            Auth::guard('salesperson')->loginUsingId($user->id);

            session([
                'salesperson_id'    => $user->id,
                'salesperson_email' => $user->email,
                'salesperson_name'  => $user->name,
                'salesperson_p_id'  => $user->parent_id,
                'is_salesperson'    => true,
            ]);
            return redirect()->route('retailer');
        } else {
            Auth::guard('salesperson')->logout();
            return redirect()->route('retailer.shop.login')->withErrors(['role' => 'Your account is not authorized as a Sales Person.']);
        }
    }

    return back()->withErrors([
        'email' => 'The provided credentials are incorrect.',
    ]);
}


    public function logout()
    {
        Auth::guard('salesperson')->logout();
        session()->flush();
        session()->flash('message', 'You have been logged out successfully.');  
        return redirect()->route('login');  
    }

}


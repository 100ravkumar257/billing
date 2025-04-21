<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateSalesperson
{
    // public function handle(Request $request, Closure $next)
    // {
    //     if (Auth::guard('salesperson')->check()) {
    //         //return redirect()->route('retailer');
    //         return $next($request);
    //     }

    //     return redirect()->route('retailer.shop.login'); 

    // }

    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('salesperson')->check()) {
            return redirect()->route('login');  
        }

        return $next($request);
    }

}


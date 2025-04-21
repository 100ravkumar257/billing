<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $guard = $exception->guards()[0] ?? null;

        switch ($guard) {
            case 'salesperson':
                // return redirect()->route('retailer.shop.login');
                // return redirect()->route('login');   
                return redirect('admin/login');
            default:
                return redirect()->guest('/admin/login');
        }
    }




    // public function render($request, Exception $exception)
    // {
    //     if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
    //         return response()->json(['User have not permission for this page access.']);
    //     }
    //     return parent::render($request, $exception);
    // }

    
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;     

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function login_go(Request $request)
    {
        $rules = [
            'email'     => 'required|email|max:255',
            'password'  => 'required',
            'remember'  => 'nullable',
        ];

        $messages = [
            'email.required'        => __('auth.form.validation.email.required'),
            'email.email'           => __('auth.form.validation.email.email'),
            'email.exists'          => __('auth.form.validation.email.exists'),
            'password.required'     => __('auth.form.validation.email.required'),
        ];

        $data = $this->validate($request, $rules, $messages);

        if (!isset(request()->remember)) {
            $data['remember'] = "off";
        }

        $user = \App\Models\User::where('email', $data['email'])->first();
            if (!$user) {
                \Log::error('User not found with email: ' . $data['email']);
            } else {
                \Log::info('Stored Password:', ['password' => $user->password]);
                if (\Illuminate\Support\Facades\Hash::check($data['password'], $user->password)) {
                    \Log::info('Password match for user: ' . $user->email);
                } else {
                    \Log::error('Password mismatch for user: ' . $user->email);
                }
            }

           

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $request->get('remember'))) {
            if (Auth::user()->status == 1) {

                $hasSalesPersonRole = DB::table('model_has_roles')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->where('model_has_roles.model_id', $user->id)
                ->where('roles.id', 8)  
                ->exists();

                if ($hasSalesPersonRole) {
                    session([
                        'salesperson_id'    => $user->id,
                        'salesperson_email' => $user->email,
                        'salesperson_name'  => $user->name,
                        'salesperson_p_id'  => $user->parent_id,
                        'is_salesperson'    => true,
                    ]);                
                } 
                Toastr::success('Welcome !');
                return redirect()->intended('/admin/dashboard');
            }else{
                Auth::logout();
                Toastr::error('Your account is Deactivated by Admin!');
                return redirect()->back();
            }
        }else{
            Toastr::error('Credentials Missmatch!');
            return redirect()->back();
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('admin/login');
    }
}

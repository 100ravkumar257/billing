<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelUserActivity\Traits\Loggable;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles, Loggable;

    // protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'gstin',  
        'pan_no', 
        'image',
        'status',
        'parent_id',
        'approver',
    ];
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

    public function getRoleCodes()
    {
        $user = Auth::user();
        return $roles = Role::where('name',$user->getRoleNames())->get();
    }
//     protected static function boot()
// {
//     parent::boot();

//     static::creating(function ($user) {
//         // Check if the mobile number already exists
//         if (User::where('mobile', $user->mobile)->exists()) {
//             throw new \Illuminate\Validation\ValidationException("The mobile number has already been taken.");
//         }
//     });
// }

}

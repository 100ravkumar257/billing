<?php

namespace App\Models\Frontend\Retailer;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesperson extends Model implements AuthenticatableContract
{
    use Authenticatable, HasFactory;

    protected $table = 'users'; // Ensure this is correct
    protected $primaryKey = 'id';

    protected $fillable = ['email', 'password']; // Ensure all necessary fields are added

    protected $hidden = ['password']; // Ensure password is hidden in output

  
}


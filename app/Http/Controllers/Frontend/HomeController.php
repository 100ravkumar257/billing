<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function index()
    {
        
// echo "hello";exit;

        return view('frontend.index');
    }
}

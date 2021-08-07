<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('home', ['categories'=>Auth::user()->categories]);
        } else {
            return view('home', ['categories'=>[]]);
        }
    }
}

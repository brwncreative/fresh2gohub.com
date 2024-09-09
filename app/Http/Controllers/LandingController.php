<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }
    public function login()
    {
        return view('login');
    }
    public function results()
    {
        return view('results');
    }
    public function orders()
    {
        return view('orders');
    }
    public function checkout()
    {
        return view('checkout');
    }
    public function dashboard($purpose = '/')
    {
        return view('dashboard', ['purpose' => $purpose]);
    }
}

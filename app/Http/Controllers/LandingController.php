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
    public function results(){
        return view('results');
    }
}

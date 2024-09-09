<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public static function login($email, $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            Session::regenerate();
            switch (Auth::user()->role) {
                case 'guest':
                    return redirect()->route('welcome');
                case 'admin':
                    return redirect()->route('dashboard');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::regenerate();
        return redirect()->route('welcome');
    }
}

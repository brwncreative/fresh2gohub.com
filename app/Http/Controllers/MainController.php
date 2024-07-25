<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function default(){
        return view('main',['title'=>'Join our mailing list']);
    }

    public function welcome(){
        return view('main',['title' => 'Thank you for joining us']);
    }
}

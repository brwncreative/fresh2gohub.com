<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
    public function send($via, $message = null)
    {
        switch ($via) {
            case 'marketing':
                break;
            case 'orders':
                break;
            case 'hr':
                break;
        }
    }
}

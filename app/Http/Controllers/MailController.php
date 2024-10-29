<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function send($via, string|array $recipient = '?', $order = '?', $subject = '?', $message = '?')
    {
        switch ($via) {
            case 'marketing':
                Config::set('mail.default', 'smtp');
                Config::set('mail.from.address', 'marketing@fresh2gohub.com');
                Mail::to($recipient)->send(new \App\Mail\WelcomeMailing($recipient));
                return;
            case 'invoice':
                Config::set('mail.default', 'smtp-orders');
                Config::set('mail.from.address', 'orders@fresh2gohub.com');
                foreach ($recipient as $to) {
                    Mail::to($to)->send(new \App\Mail\Order($order));
                }
                return;
            case 'hr':
                Config::set('mail.default', 'smtp');
                Config::set('mail.from.address', 'marketing@fresh2gohub.com');
                foreach ($recipient as $to) {
                    Mail::to($to)->send(new \App\Mail\Template($subject, $message));
                }
                return;
        }
    }
}

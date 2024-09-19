<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public static function saveOrderImageLocal($ticket, $file)
    {
        if (isset($file)) {
            $ext = str_replace('image/', '', $file->getMimeType());
            $local = fopen(base_path('images\\orders\\' . $ticket . '.' . $ext), 'w');
            fwrite($local, $file->get());
            fclose($local);
        }
    }
    /**
     * Serve Image file
     *  - serve an image file url
     */
    public static function serveImage($filename, $type)
    {
        return env('CDN_URL') . env('SERVE_URL') . $filename . '.' . $type;
    }
}

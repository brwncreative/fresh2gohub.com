<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Serve Image file
     *  - serve an image file url
     */
    public static function serveImage($filename, $type)
    {
        return env('CDN_URL') . env('SERVE_URL') . $filename . '.' . $type;
    }
}

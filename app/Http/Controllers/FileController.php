<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FileController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function search()
    {
    }

    /**
     * Store File in GitHub repo
     * - Store the file in the github repo and return cdn link
     */
    public static function storeImageFile($filename, $file)
    {
        if (isset($file)) {
            $resp = Http::withToken(env('GITHUB_TOKEN'))->put('https://api.github.com/repos/brwncreative/Fresh2GoHub/contents/resources/images/' . $filename, ['message' => 'image', 'content' => base64_encode($file)]);
            if ($resp->created()) {
                return env('CDN_URL') . $filename;
            }
        } else return;
    }

    /**
     * Serve Image file
     *  - serve an image file url
     */
    public static function serveImageFile($filename, $type)
    {
        return env('CDN_URL').env('SERVE_URL').$filename.'.'.$type; 
    }
}

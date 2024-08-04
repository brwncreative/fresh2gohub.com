<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Buglinjo\LaravelWebp\Facades\Webp;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search()
    {
    }
    /**
     * Convert image to webp
     * - We store tmp image file from livewire blade
     * Then we run a python script for conversion and return the data stream
     * 
     */
    public static function convertToWebp($filename, $file)
    {
        $ext = str_replace('image/', '', $file->getMimeType());
        $conv = null;

        $conv = Http::post('http://127.0.0.1:5001/webp', ['filename' => $filename, 'ext' => $ext, 'content' => base64_encode($file->get())]);
        dd($conv->body());

        if (str_contains($conv->body(), "success")) {
            return base64_decode(file_get_contents(base_path('images\\' . $filename . '.jpeg')));
        }
    }

    /**
     * Store File in GitHub repo
     * - Store the file in the github repo and return cdn link
     */
    public static function storeImageFile($filename, $file)
    {
        self::convertToWebp($filename, $file);
        if (isset($file)) {
            $resp = Http::withToken(env('GITHUB_TOKEN'))->put(env('GITHUB_STORE') . $filename . '.jpeg', ['message' => 'image', 'content' => base64_encode(self::convertToWebp($filename, $file))]);
            return $resp->created();
        }
    }

    /**
     * Serve Image file
     *  - serve an image file url
     */
    public static function serveImageFile($filename, $type)
    {
        return env('CDN_URL') . env('SERVE_URL') . $filename . '.' . $type;
    }
}

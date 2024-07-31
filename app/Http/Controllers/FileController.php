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
        $conn = null;

        if (isset($file)) {
            $stream = $file->get();
            $conn = fopen(base_path('images\\'.$filename.'.'.$ext), 'w');
            fwrite($conn, $stream);
            fclose($conn);
        }

        $run = shell_exec(".\..\.venv\Scripts\python.exe .\..\app\Http\Controllers\FileController.py  $filename $ext .\..\images\ 2>&1");
        dd($run);
    }

    /**
     * Store File in GitHub repo
     * - Store the file in the github repo and return cdn link
     */
    public static function storeImageFile($filename, $ext, $file)
    {
        self::convertToWebp($filename, $file);
        // if (isset($file)) {
        //     $resp = Http::withToken(env('GITHUB_TOKEN'))->put(env('GITHUB_STORE') . $filename . '.'.$ext, ['message' => 'image', 'content' => base64_encode($file->get())]);
        //     return $resp->created();
        // }
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

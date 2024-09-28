<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public static function saveOrderImageLocal($ticket, $file)
    {
        if (isset($file)) {
            $ext = str_replace('image/', '', $file->getMimeType());
            $local = fopen(base_path('resources/media/orders/' . $ticket . '.' . $ext), 'w');
            fwrite($local, $file->getContent());
            fclose($local);
        }
    }

    /**
     * Save image in git cloud
     * @param mixed $stream
     * @return void
     */
    public static function saveProductImageCloud($filename, $id = '?', $ext = '.webp')
    {
        $previous = Http::withToken(env('GITHUB_TOKEN'))->get(env('GITHUB_STORE') . 'product-' . $id . $ext);
        $sha = $previous ? $previous->json('sha') : '';
        if (file_exists(base_path('resources/media/' . $filename . $ext))) {
            $resp = Http::withToken(env('GITHUB_TOKEN'))->put(env('GITHUB_STORE') . 'product-' . $id  . $ext, ['message' => "image upload", 'content' => base64_encode(file_get_contents(base_path('resources/media/' . $filename . $ext))), 'sha' => $sha]);
        }
        if ($resp->created()) {
        }
    }
    /**
     * Delete image from github
     * @return void
     */
    public static function deleteProductImageCloud($id)
    {
        $previous = Http::withToken(env('GITHUB_TOKEN'))->get(env('GITHUB_STORE') . 'product-' . $id . '.webp');
        $sha = $previous ? $previous->json('sha') : '';
        if ($sha) {
            $resp = Http::withToken(env('GITHUB_TOKEN'))->delete(env('GITHUB_STORE') . 'product-' . $id  . '.webp', ['message' => "image upload", 'sha' => $sha]);
            if($resp->ok()){
            }
        }
    }

    /**
     * Summary of saveFile
     * @param mixed $stream
     * @param mixed $filename
     * @param mixed $destination
     * @return void
     */
    public static function saveFile($stream, $filename = '?', $destination = '?')
    {
        // Remove filename old ext
        $fn = function () use ($filename) {
            return str_replace(['.jpg', '.jpeg', '.png', '.webp'], '', $filename);
        };
        // Create from byte stream
        $image = imagecreatefromstring($stream);
        // Scale Image down
        $scaled = imagescale($image, (imagesx($image) - imagesx($image) * .35));
        imagedestroy($image);
        // Convert to Webp
        imagewebp($scaled, base_path('resources/media/' . $fn() . '.webp'), 75);
        imagedestroy($scaled);
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

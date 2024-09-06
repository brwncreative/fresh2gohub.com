<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public static function findBy($find, $by)
    {
        switch ($by) {
            case 'tag':
                return Product::all();
            case 'category':
                return;
        }
    }
}

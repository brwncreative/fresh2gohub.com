<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Livewire\Attributes\Rule;

class ProductController extends Controller
{
    /**
     * Return all
     * @return Collection
     */
    public static function index()
    {
        return Product::all();
    }
    /**
     * Return all
     */
    public static function indexSpecificTag($tags)
    {
        return Product::where('tags','like','%'.$tags.'%');
    }
    /**
     * Create a product
     */
    public static function create($name, $description,$tags, $in_stock, $stock, $options, $price)
    {
        Product::createOrFirst([
            'name' => $name,
            'tags' => $tags,
            'description' => $description,
            'in_stock' => $in_stock,
            'stock' => $stock,
            'options' => $options,
            'price' => $price
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}

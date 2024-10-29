<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Find Product
     * @param mixed $find
     * @param mixed $by
     */
    public static function search($find)
    {
        return Product::whereAny(['category', 'provider', 'name'], 'LIKE', '%' . $find . '%')
            ->orWhereHas('tags', function ($query) use ($find) {
                $query->where('tags.tag', 'LIKE', '%' . $find . '%');
            })
            ->limit(10)
            ->get();
    }
    /**
     * Grab specific products
     * @param mixed $find
     * 
     */
    public static function grab($find, $chunk = 0, $limit = 4)
    {
        $chunks = Product::whereHas('tags', function ($query) use ($find) {
            $query->where('tag', 'like', '%' . $find . '%');
        })->get()->chunk($limit);

        if ($chunks->has($chunk)) {
            return $chunkpkg = [
                'size' => sizeof($chunks),
                'position' => $chunk,
                'chunk' => $chunks[$chunk]
            ];
        }
    }
    /**
     * Get Products to paginate result
     * @param mixed $limit
     * @param mixed $chunk
     * @return mixed
     * 
     */
    public static function paginate($find = '?', $chunk = 0, $limit = 10)
    {
        if ($find == '?') {
            $chunks = Product::all()->reverse()
                ->chunk($limit);

            if ($chunks->has($chunk)) {
                return $chunkpkg = [
                    'size' => sizeof($chunks),
                    'position' => $chunk,
                    'chunk' => $chunks[$chunk]
                ];
            } else {
                return $chunkpkg = [
                    'size' => 0,
                    'position' => $chunk,
                    'chunk' => []
                ];
            }
        }

        $chunks = Product::whereAny(['category', 'provider', 'name'], 'LIKE', '%' . $find . '%')
            ->orWhereHas('tags', function ($query) use ($find) {
                $query->where('tags.tag', 'LIKE', '%' . $find . '%');
            })
            ->get()
            ->chunk($limit);

        if ($chunks->has($chunk)) {
            return $chunkpkg = [
                'size' => sizeof($chunks),
                'position' => $chunk,
                'chunk' => $chunks[$chunk]
            ];
        } else {
            return $chunkpkg = [
                'size' => 0,
                'position' => $chunk,
                'chunk' => []
            ];
        }
    }
    /**
     * Paginate with filters
     * @param mixed $find
     * @param mixed $price
     * @param mixed $chunk
     * @param mixed $limit
     * @return mixed
     */
    public static function paginateWithFilters($find = '?', $price, $chunk = 0, $limit = 10)
    {
        $chunks = Product::whereAny(['category', 'provider', 'name'], 'LIKE', '%' . $find . '%')
            ->whereRelation('prices', 'value', '<=', $price)
            ->orWhereRelation('tags', 'tag', 'LIKE', '%' . $find . '%')
            ->whereRelation('prices', 'value', '<=', $price)
            ->get()
            ->chunk($limit);

        if ($chunks->has($chunk)) {
            return $chunkpkg = [
                'size' => sizeof($chunks),
                'position' => $chunk,
                'chunk' => $chunks[$chunk]
            ];
        } else {
            return $chunkpkg = [
                'size' => 0,
                'position' => $chunk,
                'chunk' => []
            ];
        }
    }

    /**
     * Summary of create
     * @param mixed $id
     * @param mixed $category
     * @param mixed $provider
     * @param mixed $name
     * @param mixed $description
     * @param mixed $available
     * @param mixed $stock
     * @param mixed $tags
     * @param mixed $options
     * @param mixed $prices
     * @return TModel
     */
    public static function create(
        $id,
        $category,
        $provider,
        $name,
        $description,
        $available,
        $stock,
        $tags = '?',
        $options = '?',
        $prices = '?',
    ) {
        // Create product
        $product = Product::updateOrCreate([
            'id' => $id,
        ], [
            'category' => $category,
            'provider' => $provider,
            'name' => $name,
            'description' => $description,
            'available' => $available,
            'stock' => $stock
        ]);
        // Attach tags, options and prices
        DB::table('tags')->where('product_id', '=', $product->id)->delete();
        DB::table('options')->where('product_id', '=', $product->id)->delete();
        DB::table('prices')->where('product_id', '=', $product->id)->delete();
        $product->tags()->createMany(self::serializeTags($tags, $product->id));
        $product->options()->createMany(self::serializeOptions($options, $product->id));
        $product->prices()->createMany(self::serializePrices($prices, $product->id));

        return $product;
    }

    public static function serializeTags($tags, $id)
    {
        $array = [];
        foreach ($tags as $tag) {
            array_push($array, ['tag' => $tag, 'product_id' => $id]);
        }
        return $array;
    }
    public static function serializeOptions($options, $id)
    {
        $array = [];
        foreach ($options as $option) {
            array_push($array, ['option' => $option['option'], 'value' => $option['value'], 'product_id' => $id]);
        }
        return $array;
    }
    public static function serializePrices($prices, $id)
    {
        $array = [];
        foreach ($prices as $price) {
            array_push($array, ['value' => $price['value'], 'metric' => $price['metric'], 'product_id' => $id]);
        }
        return $array;
    }
    /**
     * Remove product from database
     * @param mixed $id
     * @return void
     */
    public static function remove($id)
    {
        DB::table('products')->delete($id);
    }

    public static function index()
    {
        return Product::all()->reverse();
    }
}

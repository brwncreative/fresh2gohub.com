<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Prices;
use App\Models\Options;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{
    /**
     * Find Product
     * @param mixed $find
     * @param mixed $by
     */
    public static function findBy($find)
    {
        return Product::whereAny(['category', 'name'], 'like', '%' . $find . '%')->orWhereHas('tags', function (Builder $query) use ($find) {
            $query->where('tag', 'like', '%' . $find . '%');
        })->get();
    }
    public static function filter($price)
    {
        return Product::whereHas('prices', function (Builder $query) use ($price) {
            $query->where('value', '<=', $price);
        })->get();
    }
    /**
     * Create Product
     * @param mixed $category
     * @param mixed $provider
     * @param mixed $name
     * @param mixed $description
     * @param mixed $available
     * @param mixed $stock
     * @param mixed $tags
     * @param mixed $options
     * @param mixed $prices
     * @return void
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
    }

    public static function serializeTags($tags, $id)
    {
        $tags_array = [];
        $temp = explode(',', $tags);
        foreach ($temp as $tag) {
            if (strlen($tag) < 1 || $tag == null) {
                $tag = 'tag';
            }
            array_push($tags_array, ['tag' => $tag, 'product_id' => $id]);
        }
        return $tags_array;
    }
    public static function serializeOptions($options, $id)
    {
        $options_array = [];
        $temp = explode(',', $options);
        foreach ($temp as $option) {
            if (!str_contains($option, '/')) {
                $option .= 'option/0.0';
            }
            $option_tmp = explode('/', $option);
            array_push($options_array, ['option' => $option_tmp[0], 'value' => $option_tmp[1], 'product_id' => $id]);
        }
        return $options_array;
    }
    public static function serializePrices($prices, $id)
    {
        $prices_array = [];
        $temp = explode(',', $prices);
        foreach ($temp as $price) {
            if (!str_contains($price, '/')) {
                $price .= '0.0/empty';
            }
            $price_tmp = explode('/', $price);
            array_push($prices_array, ['value' => $price_tmp[0], 'metric' => $price_tmp[1], 'product_id' => $id]);
        }
        return $prices_array;
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
        return Product::all();
    }
}

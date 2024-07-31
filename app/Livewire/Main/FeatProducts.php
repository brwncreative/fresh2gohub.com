<?php

namespace App\Livewire\Main;

use App\Http\Controllers\ProductController;
use Livewire\Component;

class FeatProducts extends Component
{
    public $products;
    public $tags;

    public function unserializeTags($products)
    {
        foreach ($products as $product) {
            $product->tags = explode(",", $product->tags);
        }
    }
    public function unserializeOptions($products)
    {
        foreach ($products as $product) {
            $product->options = explode(",", $product->options);
        }
    }

    public function boot()
    {

        if (isset(self::$tags)) {
            $this->products = ProductController::indexSpecificTag($this->tags);
            self::unserializeTags($this->products);
            self::unserializeOptions($this->products);
        } else {
            $this->products = ProductController::index();
            self::unserializeTags($this->products);
            self::unserializeOptions($this->products);
        }
    }

    public function addToCart($name){
 
    }

    public function render()
    {
        return view('livewire.main.feat-products');
    }
}

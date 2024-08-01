<?php

namespace App\Livewire\Main;

use App\Http\Controllers\ProductController;
use Livewire\Component;

class FeatProducts extends Component
{
    public $products;
    public $pullOnly;

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
    public function unserializeItemName()
    {
        foreach($this->products as $product){
            $product->name = str_replace('_',' ',$product->name);
        }
    }

    public function boot()
    {

        if (isset($this->pullOnly)) {
            $this->products = ProductController::indexSpecificTag($this->pullOnly);
            self::unserializeTags($this->products);
            self::unserializeOptions($this->products);
            self::unserializeItemName();
        } else {
            $this->products = ProductController::index();
            self::unserializeTags($this->products);
            self::unserializeOptions($this->products);
            self::unserializeItemName();
        }
    }

    public function render()
    {
        return view('livewire.main.feat-products');
    }
}

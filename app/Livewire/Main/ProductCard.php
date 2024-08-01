<?php

namespace App\Livewire\Main;

use Livewire\Component;

use function Laravel\Prompts\alert;

class ProductCard extends Component
{
    public $id;
    public $url;
    public $name;

    public $tags;

    public $price;
    public $options;
    public $metric;
    public function addToCart($id)
    {
        dump($id);
    }
    public function render()
    {
        return view('livewire.main.product-card');
    }
}

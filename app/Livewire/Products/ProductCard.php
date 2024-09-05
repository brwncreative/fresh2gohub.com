<?php

namespace App\Livewire\Products;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductCard extends Component
{ public $quantity = 0;

    public function callPage(){
        $this->dispatch('call-page');
    }
    public function render()
    {
        return view('livewire.products.product-card');
    }
}

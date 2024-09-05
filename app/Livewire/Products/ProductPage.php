<?php

namespace App\Livewire\Products;

use Livewire\Attributes\On;
use Livewire\Component;

class ProductPage extends Component
{
    public $state = 'in-active';

    #[On('call-page')]
    public function displayPage()
    {
        $this->state = 'active';
    }
    public function render()
    {
        return view('livewire.products.product-page');
    }
}

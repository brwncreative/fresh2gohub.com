<?php

namespace App\Livewire\Utilities;

use Livewire\Attributes\Url;
use Livewire\Component;
use App\Http\Controllers\ProductController;

class Results extends Component
{
    #[Url(keep: true)]
    public $find;
    #[Url]
    public $price = 10;
    public $filter = false;
    public $products;

    public function prepProducts()
    {
        $this->products = ProductController::findBy($this->find);
    }
    public function prepFilters($case)
    {
        switch ($case) {
            case 'filter':
                $this->filter = true;
                $this->products = ProductController::filter($this->find, $this->price);
                break;
            case 'none':
                $this->filter = false;
                self::prepProducts();
                break;
        }
    }
    public function mount()
    {
        self::prepProducts();
    }
    public function render()
    {
        return view('livewire.utilities.results');
    }
}

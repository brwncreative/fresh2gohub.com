<?php

namespace App\Livewire\Utilities;

use App\Http\Controllers\ProductController;
use Livewire\Component;

class SearchBar extends Component
{
    public $find, $products = [];

    public function prepProducts()
    {
        $this->products = ProductController::findBy($this->find);
    }
    public function search($find = '?')
    {
        $searchWhat = function () use ($find) {
            if ($find != '?') {
                return $find;
            } else {
                return $this->find;
            }
        };
        return redirect()->route('results', ['find' => $searchWhat()]);
    }
    public function updated($property)
    {
        if ($property == 'find') {
            self::prepProducts();
        }
    }
    public function render()
    {
        return view('livewire.utilities.search-bar');
    }
}

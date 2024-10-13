<?php

namespace App\Livewire\Utilities;

use App\Http\Controllers\ProductController;
use Livewire\Component;

class SearchBar extends Component
{
    public $find, $products = [];

    /**
     * Gather the products the person is searching for
     * @return void
     */
    public function prepProducts()
    {
        $this->products = ProductController::search($this->find);
    }
    /**
     * Perform the search
     * @param mixed $find
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
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
    /**
     * Handle different search string scenarios
     * @param mixed $property
     * @return void
     */
    public function updated($property)
    {
        if ($property == 'find') {
            if (strlen($this->find) < 1) {
                $this->products = [];
            } else {
                self::prepProducts();
            }
        }
    }
    public function render()
    {
        return view('livewire.utilities.search-bar');
    }
}

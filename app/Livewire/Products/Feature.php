<?php

namespace App\Livewire\Products;

use App\Http\Controllers\ProductController;
use Livewire\Component;

class Feature extends Component
{
    public $find;
    public $chunk = 0;
    public $products;
    public $chunks = [];
    public $limit = 4;

    public function mount()
    {
        self::grab();
    }
    public function grab()
    {
        $this->products = ProductController::grab($this->find, $this->chunk, $this->limit);
    }
    public function setChunk($how)
    {
        switch ($how) {
            case '+':
                if ($this->chunk < $this->products['size'] - 1) {
                    $this->chunk += 1;
                    self::grab();
                }
                break;
            case '-':
                if ($this->chunk > 0) {
                    $this->chunk -= 1;
                }
                self::grab();
                break;
        }
    }
    public function render()
    {
        return view('livewire.products.feature');
    }
}

<?php

namespace App\Livewire\Main;
use App\Http\Controllers\ProductController;
use Livewire\Component;

class FeatProducts extends Component
{
    public $products;
    public $tags;

    public function boot(){
        if(isset(self::$tags)){
            $this->products = ProductController::indexSpecificTag($this->tags);
        }else{
            $this->products = ProductController::index();
        }
    }

    public function render()
    {
        return view('livewire.main.feat-products');
    }
}

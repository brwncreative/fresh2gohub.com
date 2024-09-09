<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\On;
use App\Http\Controllers\ProductController;
use Livewire\Component;

class Products extends Component
{
    public $products;
    public $category, $provider = 'Fresh2GoHub', $name, $description, $tags, $options, $prices, $available, $stock;

    /**
     * Prep products
     * @return void
     */
    #[On('reloadProducts')]
    public function prepProducts()
    {
        $this->products = ProductController::index();
    }
    public function create()
    {
        ProductController::create(
            $this->category,
            $this->provider,
            $this->name,
            $this->description,
            $this->available,
            $this->stock,
            $this->tags,
            $this->options,
            $this->prices,
        );
        $this->dispatch('reloadProducts')->self();
    }
    public function letsUpdate($id)
    {
        $temp = $this->products->find($id);
        $this->provider = $temp->provider;
        $this->category = $temp->category;
        $this->name = $temp->name;
        // Quick conversions for use in form input
        $tags = function () use ($temp) {
            $string = (string)'';
            $count = 0;
            foreach ($temp->tags as $tag) {
                $string .= $tag['tag'];
                if (!count($temp->tags) == ($count + 1)) {
                    $string .= ',';
                }
                $count++;
            }
            return $string;
        };
        $options = function () use ($temp) {
            $string = (string)'';
            $count = 0;
            foreach ($temp->options as $option) {
                $string .= $option['option'] . '/' . $option['value'];
                if (!count($temp->tags) == ($count + 1)) {
                    $string .= ',';
                }
                $count++;
            }
            return $string;
        };
        $prices = function () use ($temp) {
            $string = (string)'';
            $count = 0;
            foreach ($temp->prices as $price) {
                $string .= $price['value'] . '/' . $price['metric'];
                if (!count($temp->prices) == ($count + 1)) {
                    $string .= ',';
                }
                $count++;
            }
            return $string;
        };
        $this->tags = $tags();
        $this->options = $options();
        $this->prices = $prices();
        $this->description = $temp->description;
        $this->available = $temp->available;
        $this->stock = $temp->stock;
    }
    public function remove($id)
    {
        ProductController::remove($id);
        $this->dispatch('reloadProducts')->self();
    }
    public function mount()
    {
        self::prepProducts();
    }
    public function render()
    {
        return view('livewire.dashboard.products');
    }
}

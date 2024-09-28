<?php

namespace App\Livewire\Dashboard;

use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MediaController;
use Livewire\Component;

class Products extends Component
{
    use WithFileUploads;
    public $products;
    public $category,
        $provider = 'Fresh2GoHub',
        $name,
        $description,
        $tags,
        $options,
        $prices,
        $available = false,
        $stock,
        $creating = false,
        $image;

    /**
     * Prep products
     * @return void
     */
    #[On('reloadProducts')]
    public function prepProducts()
    {
        $this->products = ProductController::index();
        $this->dispatch('$refresh');
    }
    #[On('update')]
    public function create(
        $id = '?',
        $category = '?',
        $provider = '?',
        $name = '?',
        $description = '?',
        $available = '?',
        $stock = '?',
        $tags = '?',
        $options = '?',
        $prices = '?',
    ) {
        ProductController::create(
            $id == '?' ? null : $id,
            $category == '?' ? $this->category : $category,
            $provider == '?' ?  $this->provider : $provider,
            $name === '?' ? $this->name : $name,
            $description == '?' ? $this->description : $description,
            $available == '?' ? $this->available : $available,
            $stock == '?'  ? $this->stock : $stock,
            $tags == '?' ? $this->tags : $tags,
            $options == '?' ? $this->options :  $options,
            $prices == '?' ? $this->prices :  $prices,
        );
        $this->dispatch('reloadProducts')->self();
    }
    #[On('remove')]
    public function remove($id)
    {
        ProductController::remove($id);
        $this->dispatch('reloadProducts')->self();
    }
    public function updated($property)
    {
        if ($property === 'image') {
            MediaController::saveFile($this->image->getContent(), $this->name);
            MediaController::saveProductImageCloud($this->name, ($this->products->first()->id + 1));
        }
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

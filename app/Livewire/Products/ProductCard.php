<?php

namespace App\Livewire\Products;

use Livewire\Attributes\On;
use Livewire\Component;

class ProductCard extends Component
{
    public $id,
        $tags,
        $name,
        $provider,
        $description,
        $options,
        $prices,
        $available,
        $category,
        $selectedOpt,
        $selectedPri;
    public $quantity = 0;

    public function callPage($id)
    {
        $this->dispatch(
            'call-page',
            id: $id,
            category: $this->category,
            available: $this->available,
            tags: $this->tags,
            name: $this->name,
            provider: $this->provider,
            description: $this->description,
            options: $this->options,
            prices: $this->prices,
            selectedOpt: $this->selectedOpt,
            selectedPri: $this->selectedPri,
            quantity: $this->quantity,
        );
    }
    public function addToCart($how)
    {
        switch ($how) {
            case '+':
                $this->quantity++;
                break;
            case '-':
                $this->quantity--;
                break;
        }
        $this->dispatch(
            'addToCart',
            how: $how,
            id: $this->id,
            tags: $this->tags,
            name: $this->name,
            provider: $this->provider,
            description: $this->description,
            options: $this->options,
            prices: $this->prices,
            selectedOpt: $this->selectedOpt,
            selectedPri: $this->selectedPri,
            quantity: $this->quantity
        );
        self::save();
    }
    public function updated($property)
    {
        switch ($property) {
            case 'selectedOpt':
                $this->dispatch('updateCart', how: 'option', id: $this->id, selectedOpt: $this->selectedOpt, selectedPri: $this->selectedPri);
                break;
            case 'selectedPri':
                $this->dispatch('updateCart', how: 'price', id: $this->id, selectedOpt: null, selectedPri: $this->selectedPri);
                break;
        }
    }
    public function save()
    {
        session(['product: ' . $this->id => $this->quantity]);
    }
    public function mount()
    {
        if (session('product: ' . $this->id)) {
            $this->quantity = session('product: ' . $this->id);
        }
    }
    public function render()
    {
        return view('livewire.products.product-card');
    }
}

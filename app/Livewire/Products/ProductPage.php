<?php

namespace App\Livewire\Products;

use Livewire\Attributes\On;
use Livewire\Component;

class ProductPage extends Component
{
    public $state = 0;
    public $id,
        $tags,
        $name,
        $provider,
        $description,
        $options,
        $prices,
        $selectedOpt,
        $selectedPri,
        $quantity,
        $available,
        $category;

    #[On('call-page')]
    public function displayPage(
        $id,
        $category,
        $available,
        $tags,
        $name,
        $provider,
        $description,
        $options,
        $prices,
        $selectedOpt,
        $selectedPri,
        $quantity
    ) {
        $this->state = 1;
        $this->id = $id;
        $this->tags =  $tags;
        $this->available = $available;
        $this->category = $category;
        $this->name = $name;
        $this->provider = $provider;
        $this->description = $description;
        $this->options = $options;
        $this->prices = $prices;
        $this->selectedOpt = $selectedOpt;
        $this->selectedPri = $selectedPri;
        $this->quantity = $quantity;
    }
    public function addToCart($how)
    {
        switch ($how) {
            case '+':
                $this->quantity++;
                $this->dispatch(
                    'addToCart',
                    how: $how,
                    id: $this->id,
                    tags: $this->tags,
                    name: $this->name,
                    provider: $this->provider,
                    description: $this->description,
                    selectedOpt: $this->selectedOpt,
                    selectedPri: $this->selectedPri
                );
                self::save();
                break;
            case '-':
                if ($this->quantity > 0) {
                    $this->quantity--;
                    $this->dispatch(
                        'addToCart',
                        how: $how,
                        id: $this->id,
                        tags: $this->tags,
                        name: $this->name,
                        provider: $this->provider,
                        description: $this->description,
                        selectedOpt: $this->selectedOpt,
                        selectedPri: $this->selectedPri
                    );
                    self::save();
                }
                break;
        }
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
        if ($this->quantity == 0) {
            session()->remove('product: ' . $this->id);
        } else {
            session(['product: ' . $this->id => $this->quantity]);
        }
    }
    public function removeAll()
    {
        $this->dispatch('removeFromCart', id: $this->id);
        $this->quantity = 0;
    }
    public function render()
    {
        return view('livewire.products.product-page');
    }
}

<?php

namespace App\Livewire\Products;

use Livewire\Attributes\On;
use Livewire\Component;

class ProductCard extends Component
{
    public function placeholder()
    {
        return <<<'HTML'
        <div class="product-card-skeleton">
            <div class="bucket">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        HTML;
    }
    public $type = 'scroll',
        $id,
        $tags,
        $name,
        $provider,
        $description,
        $options,
        $prices,
        $available,
        $category,
        $selectedOpt = 'x',
        $selectedPri = '0';
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
    public function handleCart($how)
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
                    selectedOpt: [
                        'position' => $this->selectedOpt,
                        'value' => $this->selectedOpt == 'x' ? '{"option":"Check Options", "value":0}' : json_encode($this->options[$this->selectedOpt])
                    ],
                    selectedPri: [
                        'position' => $this->selectedPri,
                        'value' => json_encode($this->prices[$this->selectedPri])
                    ]
                );
                break;
            case '-':
                if ($this->quantity > 0) {
                    $this->quantity--;
                    $this->dispatch(
                        'addToCart',
                        how: $how,
                        id: $this->id,
                    );
                }
                break;
        }
    }
    public function updated($property)
    {
        switch ($property) {
            case 'selectedOpt':
                $this->dispatch(
                    'updateCart',
                    how: 'option',
                    id: $this->id,
                    selectedOpt: [
                        'position' => $this->selectedOpt,
                        'value' => $this->selectedOpt == 'x' ? '{"option":"Check Options", "value":0}' : json_encode($this->options[$this->selectedOpt])
                    ],
                    selectedPri: [
                        'position' => $this->selectedPri,
                        'value' => json_encode($this->prices[$this->selectedPri])
                    ]
                );
                break;
            case 'selectedPri':
                $this->dispatch(
                    'updateCart',
                    how: 'price',
                    id: $this->id,
                    selectedOpt: null,
                    selectedPri: [
                        'position' => $this->selectedPri,
                        'value' => json_encode($this->prices[$this->selectedPri])
                    ]
                );
                break;
        }
    }
    #[On('handshakeCard')]
    public function handshake()
    {
        if (session('cart')) {
            if (array_key_exists('product: ' . $this->id, session('cart'))) {
                $this->quantity = session('cart')['product: ' . $this->id]['quantity'];
                $this->selectedOpt = session('cart')['product: ' . $this->id]['selectedOpt']['position'];
                $this->selectedPri = session('cart')['product: ' . $this->id]['selectedPri']['position'];
                return;
            }
        } else {
            $this->quantity = 0;
        }
        return;
    }
    public function mount()
    {
        self::handshake();
    }
    public function render()
    {
        return view('livewire.products.product-card');
    }
}

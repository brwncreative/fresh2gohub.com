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
        $selectedOpt,
        $optPlaceholder = ['option' => 'Check Options', 'value' => '{"option":"Check Options", "value":0}'],
        $priPlaceholder = ['value' => null, 'price' => null],
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
            selectedOpt: $this->optPlaceholder,
            selectedPri: $this->priPlaceholder,
            quantity: $this->quantity,
        );
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
                    selectedOpt: $this->optPlaceholder['value'],
                    selectedPri: $this->priPlaceholder['value']
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
                $this->dispatch('updateCart', how: 'option', id: $this->id, selectedOpt: $this->selectedOpt, selectedPri: $this->selectedPri);
                break;
            case 'selectedPri':
                $this->dispatch('updateCart', how: 'price', id: $this->id, selectedOpt: null, selectedPri: $this->selectedPri);
                break;
        }
    }
    #[On('handshakeCard')]
    public function handshake()
    {
        if (session('cart')) {
            if (array_key_exists('product: ' . $this->id, session('cart'))) {
                $this->quantity = session('cart')['product: ' . $this->id]['quantity'];
                $temp = json_decode(session('cart')['product: ' . $this->id]['selectedOpt'], true);
                $temp2 = json_decode(session('cart')['product: ' . $this->id]['selectedPri'], true);
                $this->optPlaceholder['option'] = $temp['option'];
                $this->optPlaceholder['value'] = session('cart')['product: ' . $this->id]['selectedOpt'];
                $this->priPlaceholder['price'] = '$' . $temp2['value'] . ' / ' . $temp2['metric'];
                $this->priPlaceholder['value'] = session('cart')['product: ' . $this->id]['selectedPri'];
                $temp = null;
                $temp2 = null;
                return;
            }
        } else {
            $this->quantity = 0;
        }

        $this->priPlaceholder['value'] = json_encode($this->prices[0]);
        $this->priPlaceholder['price'] = '$' . $this->prices[0]['value'] . ' / ' . $this->prices[0]['metric'];
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

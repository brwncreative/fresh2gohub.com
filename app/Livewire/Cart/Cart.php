<?php

namespace App\Livewire\Cart;

use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    public $items = 0;
    public $cart = [];

    #[On('addToCart')]
    public function addToCart(
        $how,
        $id,
        $tags = '?',
        $name = '?',
        $provider = '?',
        $description = '?',
        $selectedOpt = '?',
        $selectedPri = '?'
    ) {
        switch ($how) {
                // Add to cart
            case '+':
                $count = 0;
                foreach ($this->cart as $item) {
                    if ($item['id'] == $id) {
                        $this->cart[$count]['quantity']++;
                        self::save();
                        dump($this->cart);
                        return;
                    }
                   
                    $count++;
                }
                array_push($this->cart, [
                    'id' => $id,
                    'tags' => $tags,
                    'name' => $name,
                    'quantity' => 1,
                    'provider' => $provider,
                    'description' => $description,
                    'selectedOpt' => $selectedOpt,
                    'selectedPri' => $selectedPri
                ]);
                dump($this->cart);
                self::save();
                return;
                // Remove from cart
            case '-':
                $count = 0;
                foreach ($this->cart as $item) {
                    if ($item['id'] == $id) {
                        if ($item['quantity'] - 1 === 0) {
                            unset($this->cart[$count]);
                            $this->cart = array_values($this->cart);
                            self::save();
                            return;
                        }
                        $this->cart[$count]['quantity']--;
                        self::save();
                        return;
                    }
                    $count++;
                }
                return;
        }
    }
    #[On('removeFromCart')]
    public function removeFromCart($id)
    {
        $count = 0;
        foreach ($this->cart as $item) {
            if ($item['id'] == $id) {
                if ($item['quantity'] - 1 === 0) {
                    unset($this->cart[$count]);
                    $this->cart = array_values($this->cart);
                    self::save();
                    return;
                }
            }
            $count++;
        }
        return;
    }
    #[On('updateCart')]
    public function updateCart() {}
    public function save()
    {
        session(['cart' => $this->cart]);
        $this->items = count($this->cart);
    }

    public function mount()
    {
        if (session('cart')) {
            $this->cart = session('cart');
            $this->items = count($this->cart);
        }
    }
    public function render()
    {
        return view('livewire.cart.cart');
    }
}

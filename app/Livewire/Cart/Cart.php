<?php

namespace App\Livewire\Cart;

use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    public $items = 0;
    public $cart = [];

    // Update product quantity in session to reflect cart quantity
    public function updateQuantity($id, $quantity)
    {
        if ($quantity == 0) {
            session()->remove('product: ' . $id);
        }
        session(['product: ' . $id => $quantity]);
    }
    // Add to cart
    #[On('addToCart')]
    public function addToCart(
        $how,
        $id,
        $source = '?',
        $tags = '?',
        $name = '?',
        $provider = '?',
        $description = '?',
        $selectedOpt = '?',
        $selectedPri = '?'
    ) {
        switch ($how) {
            case '+':
                $count = 0;
                foreach ($this->cart as $item) {
                    if ($item['id'] == $id) {
                        $this->cart[$count]['quantity']++;
                        self::save();
                        if ($source != '?') {
                            self::updateQuantity($id, $this->cart[$count]['quantity']);
                            $this->dispatch('updateCheckout');
                        }
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
                    'selectedOpt' =>  $selectedOpt,
                    'selectedPri' => $selectedPri
                ]);
                self::save();
                if ($source != '?') {
                    self::updateQuantity($id, 1);
                    $this->dispatch('updateCheckout');
                }
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
                            if ($source != '?') {
                                self::updateQuantity($item['id'], 0);
                                $this->dispatch('updateCheckout');
                            }
                            return;
                        }
                        $this->cart[$count]['quantity']--;
                        self::save();
                        if ($source != '?') {
                            self::updateQuantity($item['id'], $this->cart[$count]['quantity']);
                            $this->dispatch('updateCheckout');
                        }
                        return;
                    }
                    $count++;
                }
                return;
        }
    }
    // Remove all items from cart by product ID
    #[On('removeFromCart')]
    public function removeFromCart($id, $source = '?')
    {
        $count = 0;
        foreach ($this->cart as $item) {
            if ($item['id'] == $id) {
                if (session('product: ' . $item['id'])) {
                    session()->remove('product: ' . $id);

                    if ($source != '?') {
                        self::updateQuantity($item['id'], 0);
                        $this->dispatch('updateCheckout');
                    }

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
    // Update cart if option changed while product is added
    #[On('updateCart')]
    public function updateCart($how, $id, $selectedOpt = null, $selectedPri = null)
    {
        switch ($how) {
            case 'option':
                if (count($this->cart) > 0) {
                    $count = 0;
                    foreach ($this->cart as $item) {
                        if ($item['id'] == $id) {
                            $this->cart[$count]['selectedOpt'] = $selectedOpt;
                            self::save();
                            return;
                        }
                        $count++;
                    }
                }
                return;
            case 'price':
                if (count($this->cart) > 0) {
                    $count = 0;
                    foreach ($this->cart as $item) {
                        if ($item['id'] == $id) {
                            $this->cart[$count]['selectedPri'] = $selectedPri;
                            self::save();
                            return;
                        }
                        $count++;
                    }
                }
                return;
        }
    }
    // Save cart to session
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

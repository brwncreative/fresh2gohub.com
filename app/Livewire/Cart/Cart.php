<?php

namespace App\Livewire\Cart;

use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    public $items = 0;
    public $cart = [];

    #[On('paymentMade')]
    public function paymentMade()
    {
        session()->remove('cart');
        $this->cart = [];
        self::save();
    }
    // Handshake
    public function handshake()
    {
        self::save();
        $this->dispatch('handshakeCard');
        $this->dispatch('handshakePage');
        $this->dispatch('handshakeCheckout');
    }
    // Save cart to session
    public function save()
    {
        session(['cart' => $this->cart]);
        $this->items = count($this->cart);
    }
    // Load the cart from outside the regular scope
    public function loadCartExternally($order) {}
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
                /**
             * Add to cart case
             */
            case '+':
                if (!(array_key_exists('product: ' . $id, $this->cart))) {
                    $this->cart += array('product: ' . $id => [
                        'id' => $id,
                        'tags' => $tags,
                        'name' => $name,
                        'quantity' => 1,
                        'provider' => $provider,
                        'description' => $description,
                        'selectedOpt' =>  $selectedOpt,
                        'selectedPri' => $selectedPri
                    ]);
                    self::handshake();
                } else if (array_key_exists('product: ' . $id, $this->cart)) {
                    $this->cart['product: ' . $id]['quantity'] = $this->cart['product: ' . $id]['quantity'] + 1;
                    self::handshake();
                }
                break;
                /**
                 * Remove from cart case
                 */
            case '-':
                if (array_key_exists('product: ' . $id, $this->cart)) {
                    if ($this->cart['product: ' . $id]['quantity'] - 1 == 0) {
                        unset($this->cart['product: ' . $id]);
                    } else {
                        $this->cart['product: ' . $id]['quantity'] = $this->cart['product: ' . $id]['quantity'] - 1;
                    }
                    self::handshake();
                }
                break;
        }
    }
    // Remove all items from cart by product ID
    #[On('removeFromCart')]
    public function removeFromCart($id, $source = '?')
    {
        if (array_key_exists('product: ' . $id, $this->cart)) {
            unset($this->cart['product: ' . $id]);
        }
        self::handshake();
    }

    // Update cart if option changed while product is added
    #[On('updateCart')]
    public function updateCart($how, $id, $selectedOpt = '?', $selectedPri = '?')
    {
        switch ($how) {
            case 'option':
                if (array_key_exists('product: ' . $id, $this->cart)) {
                    $this->cart['product: ' . $id]['selectedOpt'] = $selectedOpt;
                    self::handshake();
                }
                break;
            case 'price':
                if (array_key_exists('product: ' . $id, $this->cart)) {
                    $this->cart['product: ' . $id]['selectedPri'] = $selectedPri;
                    self::handshake();
                }
                break;
        }
    }

    public function mount()
    {
        if (session('cart')) {
            $this->cart = session('cart');
            $this->items = count($this->cart);
        }
        if (session('orderToUpdate')) {
            foreach (session('orderToUpdate') as $order) {
            }
        }
    }
    public function render()
    {
        return view('livewire.cart.cart');
    }
}

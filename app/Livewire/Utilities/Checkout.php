<?php

namespace App\Livewire\Utilities;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Http\Controllers\MailController;

class Checkout extends Component
{
    public $order;
    public $cart,
        $total,
        $paymentOption = 'bank',
        $ticket,
        $fname,
        $lname,
        $email,
        $contact,
        $area,
        $address,
        $instructions,
        $via;
    /**
     * Make order ticket
     * @return void
     */
    public function makeOrderTicket()
    {
        if (!$this->ticket) {
            $this->ticket = strval(bin2hex(random_bytes(6)));
        }
    }
    public function pay()
    {
        // Run Validation
        $this->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'area' => 'required',
            'address' => 'required',
            'via' => 'required'
        ]);

        $user = function () {
            if (Auth::user()) {
                return Auth::user()->id;
            }
        };

        // Different Payment method handling 
        switch ($this->paymentOption) {
                // WiPay method
            case 'wipay':
                self::makeOrderTicket();
                $order =  OrderController::create(
                    $this->cart,
                    $this->ticket,
                    $this->paymentOption,
                    $this->fname . ' ' . $this->lname,
                    $this->email,
                    $this->contact,
                    $this->area,
                    $this->address,
                    $this->instructions,
                    $this->via,
                    $this->total,
                    $user()
                );

                // Empty Cart after successful payment
                $this->dispatch('paymentMade');

                $response = Http::withHeaders(['Authorization' => 't4nz74lss5r66u'])->accept('application/json')->post(
                    'https://tt.wipayfinancial.com/plugins/payments/request',
                    [
                        'account_number' => '4750666040',
                        'avs' => 1,
                        'country_code' => 'TT',
                        'currency' => 'TTD',
                        'data' => json_encode(['instructions' => $this->instructions]),
                        'environment' => 'live',
                        'fee_structure' => 'customer_pay',
                        'method' => 'credit_card',
                        'order_id' => $this->ticket,
                        'origin' => 'Fresh2GoHub',
                        'response_url' => route('orders'),
                        'total' => number_format($this->total, 2, '.', ''),
                        'addr1' => $this->address,
                        'city' => $this->area,
                        'email' => $this->email,
                        'fname' => $this->fname,
                        'lname' => $this->lname,
                        'phone' => $this->contact
                    ]
                );
                MailController::send('invoice', [$this->email, 'fresh2gohub@gmail.com'], $order);
                $url = $response->json()['url'];
                return redirect($url);

                // Bank Method
            case 'bank':
                self::makeOrderTicket();
                $order = OrderController::create(
                    $this->cart,
                    $this->ticket,
                    $this->paymentOption,
                    $this->fname . ' ' . $this->lname,
                    $this->email,
                    $this->contact,
                    $this->area,
                    $this->address,
                    $this->instructions,
                    $this->via,
                    $this->total,
                    $user()
                );
                // Empty Cart after successful payment
                $this->dispatch('paymentMade');
                MailController::send('invoice', $this->email, $order);
                return redirect()->route('orders', ['ticket' => $this->ticket]);
        }
    }

    #[On('handshakeCheckout')]
    public function handshake()
    {
        $unserialize = function () {
            foreach ($this->cart as $item) {
                if (array_key_exists('product: ' . $item['id'], $this->cart)) {
                    $this->cart['product: ' . $item['id']]['selectedPri'] = json_decode($item['selectedPri']['value'], true);
                    $this->cart['product: ' . $item['id']]['selectedOpt'] = json_decode($item['selectedOpt']['value'], true);
                }
            }
        };
        $calc = function () {
            $this->total = 0;
            foreach ($this->cart as $item) {
                if ($item['selectedOpt']['option'] == 'Check Options') {
                    $this->total += $item['selectedPri']['value'] * $item['quantity'];
                } else {
                    $this->total += $item['selectedOpt']['value'] * $item['quantity'];
                }
            }
        };

        if (session('cart')) {
            $this->cart = session('cart');
            $unserialize();
            $calc();
        } else {
            $this->cart = [];
            $this->total = 0;
        }
    }
    public function mount()
    {
        self::handshake();
    }

    public function render()
    {
        return view('livewire.utilities.checkout');
    }
}

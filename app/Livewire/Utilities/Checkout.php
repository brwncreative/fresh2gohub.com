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
        // $this->validate([]);
        $user = function () {
            if (Auth::user()) {
                return Auth::user()->id;
            }
        };

        switch ($this->paymentOption) {
                // WiPay method
            case 'wipay':
                self::makeOrderTicket();
                OrderController::create(
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
       
                $response = Http::withHeaders(['Authorization' => '123'])->accept('application/json')->post(
                    'https://tt.wipayfinancial.com/plugins/payments/request',
                    [
                        'account_number' => '1234567890',
                        'avs' => 1,
                        'country_code' => 'TT',
                        'currency' => 'TTD',
                        'data' => json_encode(['instructions' => $this->instructions]),
                        'environment' => 'sandbox',
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
                    $this->cart['product: ' . $item['id']]['selectedPri'] = json_decode($item['selectedPri'], true);
                    $this->cart['product: ' . $item['id']]['selectedOpt'] = json_decode($item['selectedOpt'], true);
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

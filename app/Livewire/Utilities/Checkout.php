<?php

namespace App\Livewire\Utilities;

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Checkout extends Component
{
    public $cart,
        $paymentOption = 'bank',
        $total, $strtotal = '0.00',
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
     * Calculate total
     * @return void
     */
    public function sum()
    {
        $this->total = 0;
        foreach ($this->cart as $item) {
            if ($item['selectedOpt']['option'] == 'Check Options') {
                $this->total += $item['selectedPri']['value'] * $item['quantity'];
            } else {
                $this->total += $item['selectedOpt']['value'] * $item['quantity'];
            }
        }
        $this->strtotal =  number_format($this->total, 2, '.', '');
    }
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

        switch ($this->paymentOption) {
                // WiPay method
            case 'wipay':
                self::makeOrderTicket();
                OrderController::create(
                    $this->cart,
                    $this->ticket,
                    $this->paymentOption,
                    $this->fname . ' ' . $this->lname,
                    $this->contact,
                    $this->area,
                    $this->address,
                    $this->instructions,
                    $this->via,
                    $this->total
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
                        'response_url' => route('checkout-response'),
                        'total' => $this->total_formatted,
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
                // $this->dispatch('order');
                OrderController::create(
                    $this->cart,
                    $this->ticket,
                    $this->paymentOption,
                    $this->fname . ' ' . $this->lname,
                    $this->contact,
                    $this->area,
                    $this->address,
                    $this->instructions,
                    $this->via,
                    $this->total
                );
                return redirect()->route('orders', ['ticket' => $this->ticket]);
        }
    }
    public function mount()
    {
        if (session('cart')) {
            $this->cart = session('cart');
            self::unserializeJson($this->cart);
            self::sum();
        }
    }
    public function unserializeJson($cart)
    {
        $count = 0;
        foreach ($cart as $item) {
            $cart[$count]['selectedPri'] = json_decode($item['selectedPri'], true);
            $cart[$count]['selectedOpt'] = json_decode($item['selectedOpt'], true);
            $count++;
        }
        return $this->cart = $cart;
    }
    public function updatePaymentOption($case)
    {
        $this->paymentOption = $case;
    }
    public function render()
    {
        return view('livewire.utilities.checkout');
    }
}

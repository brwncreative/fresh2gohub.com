<?php

namespace App\Livewire\Utilities;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OrderController;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Orders extends Component
{
    use WithFileUploads;
    #[Url(keep: false)]
    public $ticket;
    public $orders = [], $history = [], $user_id, $response, $image, $imageFromStorage;
    public $showResponse = false;
    /**
     * WiPay handshake after person has paid
     * @return void
     */
    public function getQuery()
    {
        $this->response = request()->query();
        if (array_key_exists('card', $this->response)) {
            $this->showResponse = true;
            OrderController::update($this->response['order_id'], 1, 'received');
        }
    }
    public function acknowledge($ticket)
    {
        $this->showResponse = false;
        $this->ticket = $ticket;
        self::find();
    }
    /**
     * Find specific order
     * @return void
     */
    public function find()
    {
        $this->orders = OrderController::find($this->ticket);
    }
    /**
     * Get order history if logged in
     * @return void
     */
    public function getOrderHistory()
    {
        if (Auth::check()) {
            $this->history = OrderController::getOrderHistory(Auth::user()->id);
        }
    }
    public function displayOrderImage()
    {
        $this->imageFromStorage = MediaController::checkForOrderImageLocal($this->ticket);
    }
    public function updated($property)
    {
        if ($property == 'image') {
            MediaController::saveOrderImageLocal($this->orders[0]->ticket, $this->image);
        }
    }
    public function changePaymentMethod()
    {
        session(['orderToUpdate' => $this->orders]);
        $this->redirectRoute('checkout');
    }
    public function mount()
    {
        self::getQuery();
        if ($this->ticket) {
            self::find();
        }
        self::getOrderHistory();
    }
    public function render()
    {
        return view('livewire.utilities.orders');
    }
}

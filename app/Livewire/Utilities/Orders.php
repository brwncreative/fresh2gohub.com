<?php

namespace App\Livewire\Utilities;

use App\Http\Controllers\MediaController;
use App\Http\Controllers\OrderController;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Orders extends Component
{
    use WithFileUploads;
    #[Url(keep: true)]
    public $ticket;
    public $orders = [], $history = [], $user_id, $response, $image;
    public $resp_active = false;

    public function wiPayHandshake()
    {
        if (request()->query('card')) {
            $this->resp_active = true;
            $this->response = request()->query();
            if (isset($this->response['status']) & ($this->response['status'] == 'success')) {
                OrderController::update($this->response['order_id'], true);
            }
        }
    }
    public function find()
    {
        $this->orders = OrderController::find($this->ticket);
    }
    public function mount()
    {
        self::wiPayHandshake();
        if ($this->ticket) {
            self::find();
        }
    }
    public function updated($property)
    {
        if ($property == 'image') {
            MediaController::saveOrderImageLocal($this->orders[0]->ticket, $this->image);
        }
    }
    public function render()
    {
        return view('livewire.utilities.orders');
    }
}

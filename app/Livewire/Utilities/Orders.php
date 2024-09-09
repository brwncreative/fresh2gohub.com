<?php

namespace App\Livewire\Utilities;

use App\Http\Controllers\OrderController;
use Livewire\Attributes\Url;
use Livewire\Component;

class Orders extends Component
{
    #[Url(keep: true)]
    public $ticket;
    public $orders = [], $user_id;

    public function mount()
    {
        if ($this->ticket) {
            $this->orders = OrderController::find($this->ticket);
        }
    }
    public function find()
    {
        $this->orders = OrderController::find($this->ticket);
    }
    public function render()
    {
        return view('livewire.utilities.orders');
    }
}

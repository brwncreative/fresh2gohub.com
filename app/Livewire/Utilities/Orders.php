<?php

namespace App\Livewire\Utilities;

use App\Http\Controllers\OrderController;
use Livewire\Attributes\Url;
use Livewire\Component;

class Orders extends Component
{
    #[Url(keep: true)]
    public $ticket;
    public $order;

    public function mount()
    {
        if ($this->ticket) {
            $this->order = OrderController::find($this->ticket);
        }
    }
    public function render()
    {
        return view('livewire.utilities.orders');
    }
}

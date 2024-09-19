<?php

namespace App\Livewire\Dashboard;

use App\Http\Controllers\OrderController;
use Livewire\Component;

class Orders extends Component
{
    public $orders;
    public function prepOrders()
    {
        $this->orders = OrderController::index();
    }
    public function  mount()
    {
        self::prepOrders();
    }
    public function render()
    {
        return view('livewire.dashboard.orders');
    }
}

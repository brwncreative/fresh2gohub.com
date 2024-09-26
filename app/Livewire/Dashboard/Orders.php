<?php

namespace App\Livewire\Dashboard;
use Livewire\Attributes\On;
use App\Http\Controllers\OrderController;
use Livewire\Component;

class Orders extends Component
{
    public $orders;
    #[On('reload-orders')]
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

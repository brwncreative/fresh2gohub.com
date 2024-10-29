<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\On;
use App\Http\Controllers\OrderController;
use Livewire\Component;

class Orders extends Component
{
    public $orders,
        $stages = ['received', 'prepping', 'packaged', 'out on delivery'],
        $filtering = false,
        $filterStatus,
        $filterStage;

    #[On('reload-orders')]
    public function prepOrders()
    {
        $this->orders = OrderController::index();
    }
    public function  mount()
    {
        self::prepOrders();
    }
    public function updated($property)
    {
        if ($property == 'filtering') {
            switch ($this->filtering) {
                case true:
                    $this->orders = OrderController::filterOrders($this->filterStatus == null ? '?' : $this->filterStatus, $this->filterStage == null ?  '?' : $this->filterStage);
                    break;
                case false:
                    $this->orders = OrderController::index();
                    break;
            }
        }
    }
    public function render()
    {
        return view('livewire.dashboard.orders');
    }
}

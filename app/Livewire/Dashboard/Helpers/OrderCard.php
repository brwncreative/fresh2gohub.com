<?php

namespace App\Livewire\Dashboard\Helpers;

use Livewire\Component;

class OrderCard extends Component
{ 
    public $order, $active = false;
    public function render()
    {
        return view('livewire.dashboard.helpers.order-card');
    }
}

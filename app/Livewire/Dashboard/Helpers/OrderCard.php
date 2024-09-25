<?php

namespace App\Livewire\Dashboard\Helpers;

use Livewire\Component;

class OrderCard extends Component
{ 
    public $order, $active = false, $stage, $viewScreenshot = false, $image;
    public function updated($property){
        if($property == 'viewScreenshot'){

        }
    }
    public function render()
    {
        return view('livewire.dashboard.helpers.order-card');
    }
}

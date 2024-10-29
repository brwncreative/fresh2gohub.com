<?php

namespace App\Livewire\Dashboard\Helpers;

use App\Http\Controllers\OrderController;
use Livewire\Component;
use App\Http\Controllers\MediaController;

class OrderCard extends Component
{
    public $order,
        $active = false,
        $stage,
        $paid = false,
        $viewScreenshot = false,
        $image,
        $imageFromStorage;

    public function deleteOrder()
    {
        OrderController::deleteOrder($this->order->id);
        $this->dispatch('reload-orders');
    }
    public function updated($property)
    {
        if ($property == 'viewScreenshot') {
            switch ($this->viewScreenshot) {
                case true:
                    $this->imageFromStorage = MediaController::checkForOrderImageLocal($this->order->ticket);
            }
        }
        if ($property == 'stage') {
            OrderController::update($this->order->ticket, '?', $this->stage);
        }
        if ($property == 'paid') {
            OrderController::update($this->order->ticket, $this->paid);
            $this->dispatch('reload-orders');
        }
    }
    public function mount()
    {
        $this->paid = $this->order->paid;
        $this->stage = $this->order->stage;
    }
    public function render()
    {
        return view('livewire.dashboard.helpers.order-card');
    }
}

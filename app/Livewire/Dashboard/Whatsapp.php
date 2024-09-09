<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Whatsapp extends Component
{
    public $qr;
    public function getQr()
    {
        $this->qr = Http::post('http://localhost:8080/msg')->body();
    }
    public function mount()
    {
        self::getQr();
    }
    public function render()
    {
        return view('livewire.dashboard.whatsapp');
    }
}

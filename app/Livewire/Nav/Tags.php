<?php

namespace App\Livewire\Nav;

use Livewire\Component;

class Tags extends Component
{
    public $tags;
    public function render()
    {
        return view('livewire.nav.tags');
    }
}

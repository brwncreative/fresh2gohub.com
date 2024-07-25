<?php

namespace App\Livewire\Nav;

use Livewire\Component;

class Menu extends Component
{
    public $menuItems;
    public function render()
    {
        return view('livewire.nav.menu');
    }
}

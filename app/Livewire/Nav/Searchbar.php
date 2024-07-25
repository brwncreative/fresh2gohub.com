<?php

namespace App\Livewire\Nav;

use Livewire\Component;

class Searchbar extends Component
{
    public $type;
    
    public function render()
    {
        return view('livewire.nav.searchbar');
    }
}

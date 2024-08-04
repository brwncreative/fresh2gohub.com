<?php

namespace App\Livewire\Nav;
use Livewire\Attributes\On;
use Livewire\Component;

class MiniNav extends Component
{
    public $toggle = false;


    #[On('showNav')] 
    public function showNav(){
        $this->toggle = !$this->toggle;
    }
 
    public function render()
    {
        return view('livewire.nav.mini-nav');
    }
}

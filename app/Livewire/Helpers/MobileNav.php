<?php

namespace App\Livewire\Helpers;

use Livewire\Attributes\On;
use Livewire\Component;

class MobileNav extends Component
{
    public bool $active = false;

    public function render()
    {
        return view('livewire.helpers.mobile-nav');
    }
    #[On('toggle')]
    public function display()
    {
        $this->active = !$this->active;
    }
}

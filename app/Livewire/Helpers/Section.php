<?php

namespace App\Livewire\Helpers;

use Livewire\Component;

class Section extends Component
{
    public $title, $subtitle, $text;
    public function render()
    {
        return view('livewire.helpers.section');
    }
}

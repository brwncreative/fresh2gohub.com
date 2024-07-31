<?php

namespace App\Livewire\Main;

use Livewire\Component;

class Section extends Component
{
    public $heading;
    public $text;
    public $image;

    public function render()
    {
        return view('livewire.main.section');
    }
}

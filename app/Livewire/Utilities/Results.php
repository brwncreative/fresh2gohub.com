<?php

namespace App\Livewire\Utilities;

use Livewire\Attributes\Url;
use Livewire\Component;

class Results extends Component
{
    #[Url(keep: true)]
    public $find;
    public function render()
    {
        return view('livewire.utilities.results');
    }
}

<?php

namespace App\Livewire\Announcements;

use Livewire\Component;

class Carousel extends Component
{
    public $x;
    public $pointer = 0;
    public $media = [1, 2, 3, 4, 5];

    public function queue($direction = '?')
    {
        switch ($direction) {
            case '+':
                if ($this->pointer < count($this->media)) {
                    $this->pointer++;
                }
                if ($this->pointer == (sizeof($this->media))) {
                    $this->pointer = 0;
                }
                break;
            case '-':
                if ($this->pointer > 0) {
                    $this->pointer--;
                }
                if ($this->pointer == 0) {
                    $this->pointer = sizeof($this->media) - 1;
                }
                break;
        }
    }

    public function mount()
    {
        self::queue();
    }
    public function updated($property)
    {
        if ($property == 'pointer') {
            $this->pointer > sizeof($this->media) ? $this->pointer = 0 : $this->pointer;
        }
    }
    public function render()
    {
        return view('livewire.announcements.carousel');
    }
}

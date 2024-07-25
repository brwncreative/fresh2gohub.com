<?php

namespace App\Livewire\Main;
use App\Http\Controllers\UserController;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Carousel extends Component
{

    #[Rule('required|min:2|email|unique:users')]
    public String $email;

    public function addToMailing(){
        $this->validate();
        UserController::create('mail',$this->email);
    }

    public function render()
    {
        return view('livewire.main.carousel');
    }
}

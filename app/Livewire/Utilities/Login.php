<?php

namespace App\Livewire\Utilities;

use App\Http\Controllers\AuthController;
use Livewire\Component;

class Login extends Component
{
    public $email, $password, $type = "icon", $state = 0, $how = 'icon';

    public function login()
    {
        $this->validate([
            'email' => 'required|min:3',
            'password' => 'required|min:3'
        ]);
        AuthController::login($this->email, $this->password);
    }
    public function render()
    {
        return view('livewire.utilities.login');
    }
}

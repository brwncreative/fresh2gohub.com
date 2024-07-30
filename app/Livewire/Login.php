<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Login extends Component
{
    #[Rule('required|min:2|email')]
    public $email;
    #[Rule('required|min:2')]
    public $password;
    public $login_message;
    public $evp_status;

    public function login()
    {
        $this->validate();
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            Session::regenerate();
            redirect()->intended(route('dashboard'));
        }else{
            $this->evp_status = false;
            $this->login_message = 'Wrong username or password';
        }
    }

    /**
     * Check if user exists
     *
     */
    public function exists()
    {
        $check = UserController::search($this->email);
        switch ($check) {
            case true:
                $this->evp_status = true;
                $this->login_message = 'This account exists!';
                break;
            case false:
                $this->evp_status = false;
                $this->login_message = 'Account does not exist :(';
                break;
            case null:
                $this->evp_status = false;
                $this->login_message = 'Account does not exist :(';
                break;
        }
    }
    public function updated($property)
    {
        if ($property == 'email') {
            self::exists();
        }
    }
    public function render()
    {
        return view('livewire.login');
    }
}

<?php

namespace App\Livewire\Dashboard;

use App\Http\Controllers\UserController;
use Livewire\Component;

class Users extends Component
{
    public $users;

    public function prepUsers()
    {
        $this->users = UserController::index();
    }
    public function mount() {
        self::prepUsers();
    }
    public function render()
    {
        return view('livewire.dashboard.users');
    }
}

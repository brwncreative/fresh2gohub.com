<?php

namespace App\Livewire\Dashboard;

use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use Livewire\Component;

class Users extends Component
{
    public $users, $recipients, $mlist = [], $email, $subject, $message;

    public function prepUsers()
    {
        $this->users = UserController::index();
    }
    public function sendMail()
    {
        MailController::send('hr', $this->mlist, '?', $this->subject, $this->message);
    }
    public function updated($property)
    {
        if ($property == 'recipients') {
            $this->mlist = explode(' ', $this->recipients);
        }
    }
    public function mount()
    {
        self::prepUsers();
    }
    public function render()
    {
        return view('livewire.dashboard.users');
    }
}

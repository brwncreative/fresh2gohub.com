<?php

namespace App\Livewire\Dashboard;

use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use Livewire\Component;

class Users extends Component
{
    public $users, $email, $subject, $message, $chunk = 0;
    public $recipients = [], $recipientString;

    public function prepUsers($chunk)
    {
        $this->users = UserController::paginateAll($chunk);
        $this->chunk = $chunk;
    }
    public function test()
    {
        dump('es');
    }
    public function handleUser($handle, $email = '?', $key = '?', $id = '?')
    {
        switch ($handle) {
            case 'mailBtn':
                array_push($this->recipients, $email);
                break;
            case 'mailForm':
                array_push($this->recipients, $this->recipientString);
                $this->recipientString = null;
                break;
            case 'del':
                unset($this->recipients[$key]);
                break;
        }
    }
    public function sendMail()
    {
        MailController::send('hr', $this->recipients, '?', $this->subject, $this->message);
    }
    public function mount()
    {
        self::prepUsers(0);
    }
    public function render()
    {
        return view('livewire.dashboard.users');
    }
}

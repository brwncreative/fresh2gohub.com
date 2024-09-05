<?php

namespace App\Livewire\Sections;

use Livewire\Component;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;

class Explore extends Component
{
    public $title = "Join our mailing list!", $email;

    public function handleInvitee()
    {
        $this->validate(['email' => 'required|email']);
        $response = UserController::create($this->email, 1, 'guest');
        // On successful entry into database
        if ($response == 1) {
            $this->title = 'Thank you for joining us';
        }
    }
    public function render()
    {
        return view('livewire.sections.explore');
    }
}

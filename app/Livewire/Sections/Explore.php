<?php

namespace App\Livewire\Sections;

use Livewire\Component;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

class Explore extends Component
{
    public $title = "Join our mailing list!", $email, $products, $find;

    public function handleInvitee()
    {
        $this->validate(['email' => 'required|email|unique:users,email']);
        $response = UserController::create($this->email, true, 'guest');
        // On successful entry into database
        if ($response == 1) {
            $this->dispatch('confetti');
            $this->title = 'Thank you for joining us';
            $this->dispatch('confetti');
            MailController::send('marketing', $this->email);
        }
    }
    public function featureProducts()
    {
        $this->products = ProductController::findBy($this->find, 'tag');
    }
    public function mount()
    {
        Self::featureProducts();
    }
    public function render()
    {
        return view('livewire.sections.explore');
    }
}

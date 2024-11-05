<?php

namespace App\Livewire\Sections;

use Livewire\Component;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

class Explore extends Component
{
    public $title = "Join our mailing list!", $email, $products, $find;
    public $benefits = [
        [
            'tagline' => 'Never miss out',
            'text' => 'Our news feed right in your inbox',
            'icon' => 'bi-megaphone'
        ],
        [
            'tagline' => 'Coupon Shopping',
            'text' => 'Get early access to new deals and coupons',
            'icon' => 'bi-percent'
        ],
        [
            'tagline' => 'Just getting started',
            'text' => 'Get site updates and new feature notes',
            'icon' => 'bi-flag'
        ]
    ], $pointer;

    public function handleInvitee()
    {
        $this->dispatch('confetti');
        $this->title = 'Thank you for joining us';
        MailController::send('marketing', $this->email);
        
        // $this->validate(['email' => 'required|email|unique:users,email']);
        // $response = UserController::create($this->email, true, 'guest');
        // if ($response == 1) {
        //     $this->dispatch('confetti');
        //     $this->title = 'Thank you for joining us';
        //     MailController::send('marketing', $this->email);
        // }
    }

    public function switch()
    {
        if ($this->pointer < sizeof($this->benefits) - 1) {
            $this->pointer++;
        } else {
            $this->pointer = 0;
        }
    }

    public function render()
    {
        return view('livewire.sections.explore');
    }
}

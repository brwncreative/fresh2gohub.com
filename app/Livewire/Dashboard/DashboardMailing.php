<?php

namespace App\Livewire\Dashboard;
use App\Models\User;
use Livewire\Component;

class DashboardMailing extends Component
{   public $users;

    public function boot(){
        $this->users = User::where('mailing','=',true)->get();
    }
    public function render()
    {
        return view('livewire.dashboard.dashboard-mailing');
    }
}

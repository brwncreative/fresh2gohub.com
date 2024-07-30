<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class DashboardMenu extends Component
{
    public $menu_items;
    public function render()
    {
        return view('livewire.dashboard.dashboard-menu');
    }
}

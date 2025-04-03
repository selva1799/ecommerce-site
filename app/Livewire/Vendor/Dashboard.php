<?php

namespace App\Http\Livewire\Vendor;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.vendor')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.vendor.dashboard');
    }
}

<?php
namespace App\Http\Livewire\Buyer;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.buyer')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.buyer.dashboard');
    }
}

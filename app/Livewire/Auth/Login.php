<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Layout('layouts.guest')]
class Login extends Component
{
    #[Rule('required|email')]
    public $email = '';

    #[Rule('required|min:8')]
    public $password = '';

    public $remember = false;

    public function login()
    {
        $this->validate();

        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password
        ], $this->remember)) {

            request()->session()->regenerate();

            $user = auth()->user();

            if ($user->role_id == 1) {
                return $this->redirectRoute('admin.dashboard');
            } elseif ($user->role_id == 2) {
                return $this->redirectRoute('vendor.dashboard');
            } else {
                return $this->redirectRoute('buyer.dashboard');
            }
        }

        $this->addError('email', 'These credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}

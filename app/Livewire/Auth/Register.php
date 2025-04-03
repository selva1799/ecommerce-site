<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $phone = '';
    public $address = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|confirmed|min:8',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:500',
    ];

    /**
     * Register a new user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register()
    {
        $validatedData = $this->validate();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
        ]);

        // Assign buyer role by default
        $buyerRole = Role::firstOrCreate(['name' => 'Buyer']);
        $user->assignRole($buyerRole);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.auth.register')
            ->layout('layouts.guest');
    }
}

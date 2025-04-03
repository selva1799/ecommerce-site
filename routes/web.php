<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Frontend routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin, Vendor, and Buyer dashboard routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('filament.pages.admin-dashboard'); // Corrected view path
    })->name('admin.dashboard');

    Route::get('/vendor/dashboard', function () {
        return view('livewire.vendor.dashboard'); // Corrected view path
    })->name('vendor.dashboard');

    Route::get('/buyer/dashboard', function () {
        return view('livewire.buyer.dashboard'); // Corrected view path
    })->name('buyer.dashboard');
});

<?php

/*use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Chat;

// Ruta raíz: redirige según login
Route::get('/', function () {
    return Auth::check() ? redirect()->route('chat') : redirect()->route('login');
});

// Componente Livewire del chat
Route::get('/', Chat::class)
    ->middleware(['auth', 'verified'])
    ->name('chat');

// Vistas de perfil (Breeze)
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Rutas de autenticación Breeze
require __DIR__.'/auth.php';*/


use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('chatroom', 'chatroom')
    ->middleware(['auth', 'verified'])
    ->name('chatroom');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

/*use App\Livewire\Chat;

Route::middleware('auth')->group(function () {
    Route::get('/', Chat::class)->name('chat'); // muestra el componente Livewire como página principal
});*/

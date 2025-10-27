<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('chatroom')
        : redirect()->route('login');
});

Route::view('chatroom', 'chatroom')
    ->middleware(['auth', 'verified'])
    ->name('chatroom');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

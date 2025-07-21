<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (!Auth::guard('pelanggan')->check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});

// Route::middleware(['can:auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');
// });

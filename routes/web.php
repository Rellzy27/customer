<?php

use App\Http\Middleware\TicketOwnership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


View::composer('*', function ($view) {
    if (Auth::guard('pelanggan')->check()) {
        $user = Auth::guard('pelanggan')->user();
        $view->with('user', $user);
    }
});

Route::get('/', function () {
    if (Auth::guard('pelanggan')->check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});

Route::middleware(['can:auth'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', [App\Http\Controllers\TicketController::class, 'index'])->name('dashboard');
    Route::get('/ticket/create', [App\Http\Controllers\TicketController::class, 'create'])->name('ticket.create');
    Route::post('/ticket', [App\Http\Controllers\TicketController::class, 'store'])->name('ticket.store');

}); 

Route::middleware(['can:auth', TicketOwnership::class])->group(function () {
    Route::get('/ticket/{ticket}/detail', [App\Http\Controllers\TicketController::class, 'detail'])->name('ticket.detail');
    Route::put('/ticket/{ticket}/edit', [App\Http\Controllers\TicketController::class, 'edit'])->name('ticket.edit');
    Route::get('/ticket/{ticket}/cancel', [App\Http\Controllers\TicketController::class, 'cancel'])->name('ticket.cancel');
});

require __DIR__ . '/auth.php';

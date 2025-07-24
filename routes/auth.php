<?php


use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);


Route::post('/ganti-password', [App\Http\Controllers\Auth\ProfileController::class, 'updatePassword'])->name('ganti-password');

Route::post('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'store'])->name('logout');

Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('/profile', [App\Http\Controllers\Auth\ProfileController::class, 'index'])->name('profile');
Route::post('/profile/update', [App\Http\Controllers\Auth\ProfileController::class, 'update'])->name('profile.update');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth:pelanggan')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home'); // Redirect after successful verification
})->middleware(['auth:pelanggan', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth:pelanggan', 'throttle:6,1'])->name('verification.send');
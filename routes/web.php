<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Home.home');
})->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', fn() => view('Auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/register', fn() => view('Auth.register'))->name('register.view');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/forgot-password', fn() => view('Auth.forgotPassword'))->name('password.forgot');
    Route::get('/reset-password', fn() => view('Auth.resetPassword'))->name('password.reset');
});

Route::middleware('auth')->group(function (): void {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/history-design', fn() => view('history'))->name('history.design');
    Route::get('/detail-event-design', fn() => view('detail-event'))->name('event.detail.design');
    Route::get('/list-event-design', fn() => view('list-event'))->name('event.list.design');
    Route::get('/registration-event-design', fn() => view('registration-event'))->name('event.registration.design');
    Route::get('/payment-design', fn() => view('payment'))->name('payment.design');
    Route::get('/bookmark', fn() => view('bookmark'))->name('bookmark.design');

    Route::get('/profile-design', function () {
        return redirect()->route('profile.design.show', ['user' => auth()->id()]);
    })->name('profile.design');

    Route::get('/profile-design/{user}', function (User $user) {
        return view('profile');
    })->middleware('can:owns-user,user')->name('profile.design.show');
});

Route::middleware(['auth', 'admin'])->group(function (): void {
    Route::get('/admin/dashboard', fn() => view('AdminDashboard'))->name('admin.dashboard');
});

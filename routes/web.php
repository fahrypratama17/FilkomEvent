<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


// Routing For Auth Page
Route::get('/login', fn() => view('Auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', fn() => view('Auth.register'))->name('register.view');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/forgot-password', function() {
    return view('Auth.forgotPassword');
});

Route::get('/reset-password', function() {
    return view('Auth.resetPassword');
});

// Routing to User Page
Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

Route::get('/', function () {
    return view('Home.home');
});

Route::get('/admin/dashboard', function () {
  return view('AdminDashboard');
});

Route::get('/history-design', function () {
  return view('history');
});

Route::get('/profile-design', function () {
    return view('profile');
});

Route::get('/detail-event-design', function () {
    return view('detail-event');
});

Route::get('/list-event-design', function () {
    return view('list-event');
});

Route::get('/registration-event-design', function () {
    return view('registration-event');
});

Route::get('/payment-design', function () {
    return view('payment');
});

Route::get('/bookmark', function () {
  return view('bookmark');
});

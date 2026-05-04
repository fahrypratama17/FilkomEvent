<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\EventController;

// Routing For Auth Page
Route::get('/login', fn() => view('Auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', fn() => view('Auth.register'))->name('register.view');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/forgot-password', fn() => view('Auth.forgot-password'))->name('forgotPassword');

Route::get('/reset-password/{token}', fn($token) => view('Auth.reset-password', compact('token')))->name('resetPassword');

Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword.process');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('resetPassword.process');

// Routing For Landing Page
Route::get('/', fn() => view('Home.home'));
Route::post('/kirim-email', [AuthController::class, 'sendEmail'])->name('kirim-email');

// Routing For User Page
Route::middleware(['auth', 'role:Mahasiswa'])->group(callback: function() {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');

  Route::get('/detail-event', fn() => view('Mahasiswa.detail-event'));

  Route::get('/registration-event', fn() => view('Mahasiswa.registration-event'));

  Route::get('/events', [EventController::class, 'index'])->name('events.index');
  Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

  Route::get('/payment', fn() => view('Mahasiswa.payment'));

//  Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark');
  Route::post('/bookmark/{id}', [EventController::class, 'toggleBookmark'])->name('bookmark.toggle');

  Route::get('/history', [DashboardController::class, 'history'])->name('history');
});

// Routing For Admin Page
Route::middleware(['auth', 'role:admin'])->group(function() {
  Route::get('/admin/dashboard', fn() => view('Admin.admin-dashboard'));
});
